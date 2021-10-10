<?php

namespace App\Http\Controllers\Task\DrcLocal;

use App\Http\Controllers\Controller;
use App\Model\GeneralSetup\Period;
use App\Model\Task\DdgDecisionHistory;
use Illuminate\Http\Request;

use App\Model\AccountSetup\RoleUser;
use App\Model\Task\Drc\{DrcApplication, DrcIncomplete};
use App\Model\Task\Frontend\GlobalMessage;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Templates\DrcLocal\Certificate as DrcLocalCertificate;
use App\Notifications\Drc\{Approval,AutoCancel,Incomplete,Rejection};
use DateTime;

class ActionController extends Controller
{
    protected $applicationModuleId = 3;

    public function comment(Request $request, DrcApplication $drcApplication)
    {
        $request->validate([ 'officer_id' => 'required', 'body' => 'required' ]);

        DB::transaction(function () use(&$request, &$drcApplication){
            $drcApplication->drcActionRecord()->update(['assigned_officer_id' => $request['officer_id'] ]);

            $drcApplication->drcComments()->create([
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => $request->officer_id,
                'comment' => $request->body
            ]);
        });

        $officerName = User::findOrFail($request->officer_id)->name;
        return $this->jsonResponse('success', "Successfully sent to ". $officerName, request('redirectUrl'));
    }

    public function incomplete(Request $request, DrcApplication $drcApplication)
    {
        if( $drcApplication->application_status === 'incomplete') {
            return $this->jsonResponse(
                "error", "Already made Incomplete.", request('redirectUrl')?? url()->previous()
            );
        }
        $request->validate([ 'subject' => 'required', 'body' => 'required' ]);

        $incompleteAttachments = json_decode(request('incompleteAttachments', null), true)?? [];

        DB::transaction(function () use(&$request, &$drcApplication, &$incompleteAttachments){

            $drcActionRecord = $drcApplication->drcActionRecord;

            $versionNo = 1;

            if ( $last = $drcApplication->incompletes()->where('status', 'inactive')->latest()->first() ) {
                $versionNo = $last->version_no + 1;
            }

            if ( count($incompleteAttachments) > 0 ) {
                foreach ($incompleteAttachments as $k => $incompleteAttachment) {
                    DrcIncomplete::create([
                        'drc_application_id' => $drcApplication->id,
                        'file_code' => $incompleteAttachment['file_code'],
                        'comment' => $incompleteAttachment['comment'],
                        'version_no' => $versionNo
                    ]);
                }
            } else {
                DrcIncomplete::create([
                    'drc_application_id' => $drcApplication->id,
                    'file_code' => NULL,
                    'comment' => NULL,
                    'version_no' => $versionNo
                ]);
            }



            /* $date = new DateTime('now');
            $date->modify( GeneralSetup::incompleteAutocancelPeroid(
                $this->appCode, $applicationCase->MdeviceApplication->type
            )); //+3months of current date
            $date = $date->format('Y-m-d'); */

            if ( is_null($drcActionRecord->incomplete_at) ) {
                $drcActionRecord->update(['incomplete_at' => now() ]);
            }

            $drcActionRecord->update(['assigned_officer_id' => NULL ]);

            $drcApplication->update(['application_status' => 'incomplete']);

            GlobalMessage::create([
                'department_type' => 'drug',
                'app_type' => 'drcLocal',
                'app_id' => $drcApplication->id,
                'action_type' => 'incomplete',
                'user_id' => $drcApplication->user_id,
                'subject' => $request->subject,
                'message' => $request->body,
                'redirect_url' => ''
            ]);

            $drcApplication->drcComments()->create([
                'comment_type' => 'officer_to_user',
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => NULL,
                'title' => $request->subject,
                'comment' => $request->body
            ]);

            // Mail to user
            $drcApplication->frontendUser->notify( new Incomplete($drcApplication, $request->title, $request->body));

            // Remember Incomplet Count
            $drcActionRecord->increment('incomplete_counter', 1);

        });

        // return back()->with('success', "Successfully made Incomplete.");
        return $this->jsonResponse(
            "success", "Successfully made Incomplete.", request('redirectUrl')?? url()->previous()
        );
    }

    public function autoCancel(Request $request, DrcApplication $drcApplication)
    {
        try {

            $validated = $request->validate(['subject' => 'required', 'body' => 'required']);

            $drcApplication->drcComments()->create([
                'comment_type' => 'officer_to_user',
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => NULL,
                'title' => $request->title,
                'comment' => $request->body
            ]);

            $drcApplication->drcActionRecord()->update([
                'auto_cancelled_at' => now(),
                'assigned_officer_id' => NULL
            ]);

            GlobalMessage::create([
                'department_type' => 'drug',
                'app_type' => 'drcLocal',
                'app_id' => $drcApplication->id,
                'action_type' => 'auto-cancelled',
                'user_id' => $drcApplication->user_id,
                'subject' => $request->title,
                'message' => $request->body,
                'redirect_url' => ''
            ]);

            $drcApplication->update(['application_status' => 'auto-cancelled']);

            // Emailing to User
            $drcApplication->frontendUser->notify(new AutoCancel($drcApplication, $request->body));

            return $this->jsonResponse(
                "success", "Successfully Auto Cancelled.", request('redirectUrl')?? url()->current()
            );

        } catch (\Throwable $th) {
            return $this->jsonResponse(
                "error", "Cannot auto cancel." . $th->getMessage(), request('redirectUrl')?? url()->current()
            );
        }

    }

    public function decisionalAction(Request $request)
    {
        $success = false;
        $msg = 'Successfully'. (($request->actionType === 'to-approve') ? 'Approved.' : 'Rejected.');

        $decisionCaseAccesserId = RoleUser::getDirectorId();
        if($request->caseType == 'single') {
            $success = $this->processDGorDDGAction($request->caseId, $request->actionType, $request->comment, $decisionCaseAccesserId);
        }else if($request->caseType == 'multiple') {
            $msg = 'Successfully Done';
            foreach($request->lists as $case) {
                $success = $this->processDGorDDGAction($case['caseId'], $request->actionType, $case['comment'], $decisionCaseAccesserId);
            }
        }

        if($success){
            return $this->jsonResponse('success', $msg, request('redirectUrl'));
        }
        return $this->jsonResponse('error', 'Error! Please try again', request('redirectUrl'));
    }

    public function toApprove(Request $request, DrcApplication $drcApplication)
    {
        if($this->processDGorDDGAction($drcApplication->id, 'to-approve', $request->body, RoleUser::getDirectorId())) {
            return $this->jsonResponse('success', 'Successfully Approved', request('redirectUrl'));
        }

        return $this->jsonResponse('error', 'Error! Please try again!', request('redirectUrl'));
    }

    public function toReject(Request $request, DrcApplication $drcApplication)
    {
        if($this->processDGorDDGAction($drcApplication->id, 'to-reject', $request->body, RoleUser::getDirectorId())) {
            return $this->jsonResponse('success', 'Successfully Rejected', request('redirectUrl'));
        }

        return $this->jsonResponse('error', 'Error! Please try again', request('redirectUrl'));
    }

    public function processDGorDDGAction($caseId, $actionType, $comment, $toOfficerId)
    {
        return DB::transaction(function() use (&$caseId, &$actionType, &$comment, &$toOfficerId) {
            $title = in_array($actionType, ['to-approve', 'to-approve-all']) ? 'To Approve': 'To Reject';
            $decisionStatus = in_array($actionType, ['to-approve', 'to-approve-all']) ? 'approvable': 'rejectable';

            if($drcApplication = DrcApplication::find($caseId)) {
                // To record DDG or DG action records
                DdgDecisionHistory::create(array(
                    'application_module_id' => $drcApplication->application_module_id,
                    'application_id' => $drcApplication->id,
                    'user_id' => auth()->user()->id,
                    'ts_code' => date('YmdHis'),
                    'action_name' =>   in_array($actionType, ['to-approve', 'to-approve-all'])? 'approve': 'reject',
                    'action_type' =>   in_array($actionType, ['to-approve', 'to-reject'])? 'individual': 'group'
                ));

                $drcApplication->drcComments()->create([
                    'from_officer_id' => auth()->user()->id,
                    'to_officer_id' => $toOfficerId,
                    'title' => $title,
                    'comment' => $comment
                ]);

                $drcApplication->drcActionRecord()->first()->update([
                    'assigned_officer_id' => $toOfficerId,
                    'decision_status' => $decisionStatus
                ]);

                return true;
            }
            return false;
        });

    }

    public function reject(Request $request, DrcApplication $drcApplication)
    {
        DB::transaction(function() use (&$request, &$drcApplication) {
            $now = now();
            $drcApplication->update(['application_status' => 'rejected']);

            $drcApplication->drcActionRecord()->update([
                'rejected_at' => now(),
                'assigned_officer_id' => null
            ]);

            $drcApplication->drcComments()->create([
                'comment_type' => 'officer_to_user',
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' =>null,
                'title' => $request->subject,
                'comment' => $request->body,
            ]);

            GlobalMessage::create([
                'department_type' => 'drug',
                'app_type' => $drcApplication->application_type,
                'app_id' => $drcApplication->id,
                'action_type' => 'rejected',
                'user_id' => $drcApplication->user_id,
                'subject' => $request->subject,
                'message' => $request->body,
                'redirect_url' => ''
            ]);

            $drcApplication->frontendUser->notify(new Rejection($drcApplication, $request->subject, $request->body));
        });

        return $this->jsonResponse('success', 'Successfully rejected for'. $drcApplication->application_no, request('redirectUrl'));
    }

    public function previewCertificate(Request $request, DrcApplication $drcApplication)
    {
        return (new DrcLocalCertificate($drcApplication))->generate();
    }

    public function approve(Request $request, DrcApplication $drcApplication)
    {
        if( $drcApplication->drcActionRecord->decision_status === 'rejectable') {
            return $this->jsonResponse('error', "This application is to be approved.", request('redirectUrl'));
        }

        $validated = $request->validate(['subject' => 'required', 'body' => 'required']);

        DB::transaction(function () use(&$request, &$drcApplication){

            $certificateFileId = null;

            if($drcApplication->application_type == 'new'){

                // this method must be called just after setting expire_date and issue_date
                $drcApplication->generateCertificateNo();

                //calculate expire date start
                $date = new DateTime('now');
                $date->modify('+' . (new Period)->validity($this->applicationModuleId, $drcApplication->application_type));
                $date->modify('-1 day');
                $date = $date->format('Y-m-d');

                $drcApplication->update([
                    'expire_date' => $date,
                    'issue_date' => date("Y-m-d"),
                    'application_status' => 'approved'
                ]);

                $template = new DrcLocalCertificate($drcApplication);
                $certificateFileId = $template->save();
            }

            //if renew
            if($drcApplication->application_type == 'renew'){

                $drcApplication->generateCertificateNo();
                //change old application to expired when renew is approved
                $drcApplication->parentDrcApplication()->update(['application_status' => 'expired']);

                //calculate expire date start
                $date = new DateTime($drcApplication->parentDrcApplication->expire_date);
                $date->modify('+' . (new Period)->validity($this->applicationModuleId, $drcApplication->application_type));
                $date->modify('-1 day');
                $date = $date->format('Y-m-d');

                $drcApplication->update([
                    'issue_date' => $drcApplication->parentDrcApplication->expire_date, // the expire date of the last app
                    'expire_date' => $date
                ]);

                $template = new DrcLocalCertificate($drcApplication);
                $certificateFileId = $template->save();

            }
            //if amend
            if($drcApplication->application_type == 'amend'){
                $drcApplication->parentDrcApplication()->update(['application_status' => 'expired']);
                $drcApplication->update([
                    'issue_date' => $drcApplication->parentDrcApplication->issue_date,
                    'expire_date' => $drcApplication->parentDrcApplication->expire_date
                ]);
                $template = new DrcLocalCertificate($drcApplication);
                $certificateFileId = $template->save();
            }

            $drcApplication->update(['application_status' => 'approved']);
            $drcApplication->drcActionRecord()->update([
                'certificate_file_id' => $certificateFileId,
                'approved_at' => now()
            ]);

            $drcApplication->drcComments()->create([
                'comment_type' => 'officer_to_user',
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => NULL,
                'title' => $request->subject,
                'comment' => $request->body
            ]);

            GlobalMessage::create([
                'department_type' => 'drug',
                'app_type' => 'drc local',
                'app_id' => $drcApplication->id,
                'action_type' => 'approved',
                'user_id' => $drcApplication->user_id,
                'subject' => $request->subject,
                'message' => $request->body,
                'redirect_url' => ''
            ]);

            $drcApplication->frontendUser->notify(new Approval($drcApplication, $request->subject, $request->body));

        });

        return $this->jsonResponse('success', "Successfully approved for " . $drcApplication->application_no, request('redirectUrl'));
    }
}
