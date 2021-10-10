<?php

namespace App\Http\Controllers\Task\Onetime;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductSetup\Onetime\CommentRequest;
use App\Model\Task\Onetime\{
    OnetimeApplication,
    OnetimeIncomplete
};

use DateTime;
use DB;
use App\User;
use App\Notifications\Onetime\{
    AutoCancel,
    Approval,
    Incomplete,
    Rejection
};
use App\Model\Task\Frontend\{
    User as FrontendUser,
    GlobalMessage
};
use App\Model\GeneralSetup\Period;
use App\Model\AccountSetup\RoleUser;
use App\Templates\Onetime\Certificate as OnetimeCertificate;

class ActionController extends Controller
{
    protected $applicationModuleId = 5;

    public function comment(CommentRequest $request, OnetimeApplication $onetimeApplication)
    {
        DB::transaction(function () use(&$request, &$onetimeApplication){
            $onetimeApplication->onetimeActionRecord()->update(['assigned_officer_id' => $request['officer_id'] ]);

            $diacComment = $onetimeApplication->onetimeComments()->create([
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => $request->officer_id,
                'comment' => $request->body
            ]);            
 
        });

        $officerName = User::findOrFail($request->officer_id)->name;
        return $this->jsonResponse('success', "Successfully sent to ". $officerName, request('redirectUrl'));
    }

    public function incomplete(Request $request, OnetimeApplication $onetimeApplication)
    {
        if( $onetimeApplication->application_status === 'incomplete') {
            return $this->jsonResponse(
                "error", "Already made Incomplete.", request('redirectUrl')?? url()->previous()
            );
        }
        $request->validate([ 'subject' => 'required', 'body' => 'required' ]);

        $incompleteAttachments = json_decode(request('incompleteAttachments', null), true)?? [];
        DB::transaction(function () use(&$request, &$onetimeApplication, &$incompleteAttachments){

            $onetimeActionRecord = $onetimeApplication->onetimeActionRecord;
            
            $versionNo = 1;

            if ( $last = $onetimeApplication->incompletes()->where('status', 'inactive')->latest()->first() ) {
                $versionNo = $last->version_no + 1;
            }

            foreach ($incompleteAttachments as $k => $incompleteAttachment) {
                OnetimeIncomplete::create([
                    'onetime_application_id' => $onetimeApplication->id,
                    'file_code' => $incompleteAttachment['file_code'],
                    'parent_id' => $incompleteAttachment['p_id'],
                    'comment' => $incompleteAttachment['comment'],
                    'version_no' => $versionNo
                ]);
            }            

        
            if ( is_null($onetimeActionRecord->incomplete_at) ) {
                $onetimeActionRecord->update(['incomplete_at' => now() ]);
            }

            $onetimeActionRecord->update(['assigned_officer_id' => NULL ]);

            $onetimeApplication->update(['application_status' => 'incomplete']);
          
            GlobalMessage::create([
                'department_type' => 'drug',
                'app_type' => 'onetime',
                'app_id' => $onetimeApplication->id,
                'action_type' => 'incomplete',
                'user_id' => $onetimeApplication->user_id,
                'subject' => $request->subject,
                'message' => $request->body,
                'redirect_url' => ''
            ]);

            $onetimeApplication->onetimeComments()->create([
                'comment_type' => 'officer_to_user',
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => NULL,
                'title' => $request->title,
                'comment' => $request->body
            ]);
 
            // Email to User
            $onetimeApplication->frontendUser->notify(
                new Incomplete($onetimeApplication, $request->subject, $request->body)
            ); 

            // Remember Incomplet Count
            $onetimeActionRecord->increment('incomplete_counter', 1);

        });

        // return back()->with('success', "Successfully made Incomplete.");
        return $this->jsonResponse(
            "success", "Successfully made Incomplete.", request('redirectUrl')?? url()->previous()
        );
    }

    public function autoCancel(Request $request, OnetimeApplication $onetimeApplication)
    {
        try {
            
            $validated = $request->validate(['subject' => 'required', 'body' => 'required']);
 
            $onetimeApplication->onetimeComments()->create([
                'comment_type' => 'officer_to_user',
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => NULL,
                'title' => $request->title,
                'comment' => $request->body
            ]);

            $onetimeApplication->onetimeActionRecord()->update([
                'auto_cancelled_at' => now(),
                'assigned_officer_id' => NULL
            ]);

            GlobalMessage::create([
                'department_type' => 'drug',
                'app_type' => 'onetime',
                'app_id' => $onetimeApplication->id,
                'action_type' => 'auto-cancelled',
                'user_id' => $onetimeApplication->user_id,
                'subject' => $request->subject,
                'message' => $request->body,
                'redirect_url' => ''
            ]);
 
            $onetimeApplication->update(['application_status' => 'auto-cancelled']);

            // Emailing to User
            $onetimeApplication->frontendUser->notify(new AutoCancel($onetimeApplication, $request->body));

            return $this->jsonResponse(
                "success", "Successfully Auto Cancelled.", request('redirectUrl')?? url()->current()
            );

        } catch (\Throwable $th) {
            return $this->jsonResponse(
                "error", "Cannot auto cancel." . $th->getMessage(), request('redirectUrl')?? url()->current()
            );
        }

    }

    /**
     * DG or DDG actions for To Approve and To Reject
     * $params Reqeust $request, $actionType[to-approve or to reject]
    */
    public function toApprove(Request $request, OnetimeApplication $onetimeApplication)
    {
        if(  $this->processDgOrDDGAction($onetimeApplication->id, 'to-approve', $request->body, RoleUser::getDirectorId()) ) {
            return $this->jsonResponse('success', "Successfully Approved.", request('redirectUrl'));
        }

        return $this->jsonResponse('error', 'Error!Please Try again!', request('redirectUrl'));
    }

    public function toReject(Request $request, OnetimeApplication $onetimeApplication)
    {
        if(  $this->processDgOrDDGAction($onetimeApplication->id, 'to-reject', $request->body, RoleUser::getDirectorId()) ) {
            return $this->jsonResponse('success', "Successfully Rejected.", request('redirectUrl'));
        }

        return $this->jsonResponse('error', 'Error!Please Try again!', request('redirectUrl'));
    }

    public function decisionalAction(Request $request)
    {

        $isSuccessful = false;
        $msg = 'Successfully ' . (($request->actionType === 'to-approve')? 'Approved.': 'Rejected.');

        /**
         * eachToOfficerId will be got from Role User Table
         * This ID must be Director
        */
        $decisoinCaseAccesserId = RoleUser::getDirectorId();

        if ( $request->caseType === 'single' ) {   
            $isSuccessful = $this->processDgOrDDGAction($request->caseId, $request->actionType, $request->comment, $decisoinCaseAccesserId);
        } else if ( $request->caseType === 'multiple' ) {
            $msg = 'Successfully Done.';
            foreach($request->lists as $case) {
                $isSuccessful = $this->processDgOrDDGAction($case['caseId'], $request->actionType, $case['comment'], $decisoinCaseAccesserId);                
            }

        }


        if( $isSuccessful ) {
            return $this->jsonResponse('success', $msg, request('redirectUrl'));
        }

        return $this->jsonResponse('error', 'Error!Please Try again!', request('redirectUrl'));
    }

    private function processDgOrDDGAction($caseId, $actionType, $comment, $toOfficerId)
    {
        return DB::transaction(function () use(&$caseId, &$actionType, &$comment, &$toOfficerId) {

            $title = in_array($actionType, ['to-approve', 'to-approve-all'])? 'To Approve': 'To Reject';
            $decisionStatus = in_array($actionType, ['to-approve', 'to-approve-all'])? 'approvable': 'rejectable';

            if( $onetimeApplication = OnetimeApplication::find($caseId) ) {
         
                $onetimeApplication->onetimeComments()->create([
                    'from_officer_id' => auth()->user()->id,
                    'to_officer_id' => $toOfficerId,
                    'title' => $title,
                    'comment' => $comment
                ]);
        
                $onetimeApplication->onetimeActionRecord()->first()->update([
                    'assigned_officer_id' => $toOfficerId, 
                    'decision_status' => $decisionStatus
                ]);

                return true;
            } 

            return false;

        });
    }

    public function previewRejection(Request $request, OnetimeApplication $onetimeApplication)
    {
    }
    
    public function previewCertificate(Request $request, OnetimeApplication $onetimeApplication)
    {
        return (new OnetimeCertificate($onetimeApplication))->generate();
    }

    public function approve(Request $request, OnetimeApplication $onetimeApplication)
    {
        if( $onetimeApplication->onetimeActionRecord->decision_status === 'rejectable') {
            return $this->jsonResponse('error', "This application is to be approved.", request('redirectUrl'));
        }

        $validated = $request->validate(['subject' => 'required', 'body' => 'required']);

        DB::transaction(function () use(&$request, &$onetimeApplication){

            $certificateFileId = null;
            
            if($onetimeApplication->application_type == 'new'){

                // this method must be called just after setting expire_date and issue_date
                $onetimeApplication->generateCertificateNo();
                
                //calculate expire date start
                $date = new DateTime('now'); 
                $date->modify('+' . (new Period)->validity($this->applicationModuleId, $onetimeApplication->application_type));
                $date->modify('-1 day');
                $date = $date->format('Y-m-d');

                $onetimeApplication->update([
                    'expire_date' => $date, 
                    'issue_date' => date("Y-m-d"), 
                    'application_status' => 'approved'
                ]);

                $template = new OnetimeCertificate($onetimeApplication);
                $certificateFileId = $template->save();
            }

            //if renew
            if($onetimeApplication->application_type == 'renew'){
               
                $onetimeApplication->generateCertificateNo();
                //change old application to expired when renew is approved
                $onetimeApplication->parentOnetimeApplication()->update(['application_status' => 'expired']);

                //calculate expire date start
                $date = new DateTime($onetimeApplication->parentOnetimeApplication->expire_date);
                $date->modify('+' . (new Period)->validity($this->applicationModuleId, $onetimeApplication->application_type));
                $date->modify('-1 day');
                $date = $date->format('Y-m-d');

                $onetimeApplication->update([
                    'issue_date' => $onetimeApplication->parentOnetimeApplication->expire_date, // the expire date of the last app
                    'expire_date' => $date
                ]);

                $template = new OnetimeCertificate($onetimeApplication);
                $certificateFileId = $template->save();

            }
            //if amend
            if($onetimeApplication->application_type == 'amend'){
                $onetimeApplication->parentOnetimeApplication()->update(['application_status' => 'expired']);
                $onetimeApplication->update([
                    'issue_date' => $onetimeApplication->parentOnetimeApplication->issue_date,
                    'expire_date' => $onetimeApplication->parentOnetimeApplication->expire_date
                ]);
                $template = new OnetimeCertificate($onetimeApplication);
                $certificateFileId = $template->save();                
            }

            $onetimeApplication->update(['application_status' => 'approved']);
            $onetimeApplication->onetimeActionRecord()->update([
                'certificate_file_id' => $certificateFileId,
                'approved_at' => now()
            ]);

            $onetimeApplication->onetimeComments()->create([
                'comment_type' => 'officer_to_user',
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => NULL,
                'title' => $request->subject,
                'comment' => $request->body
            ]);

            GlobalMessage::create([
                'department_type' => 'drug',
                'app_type' => 'onetime',
                'app_id' => $onetimeApplication->id,
                'action_type' => 'approved',
                'user_id' => $onetimeApplication->user_id,
                'subject' => $request->subject,
                'message' => $request->body,
                'redirect_url' => ''
            ]);

           $onetimeApplication->frontendUser->notify(
                new Approval($onetimeApplication, $request->subject, $request->body)
            ); 

        });
 
        return $this->jsonResponse('success', "Successfully approved for " . $onetimeApplication->application_no, request('redirectUrl'));
    }

    public function reject(Request $request, OnetimeApplication $onetimeApplication)
    {
        if( $onetimeApplication->onetimeActionRecord->decision_status === 'approvable') {
            return $this->jsonResponse('error', "This application is to be rejected.", request('redirectUrl'));
        }
        
        $validated = $request->validate(['subject' => 'required', 'body' => 'required']);

        DB::transaction(function () use(&$request, &$onetimeApplication){

            $now = now();

            $onetimeApplication->update([
                'application_status' => 'rejected'
            ]);

            $onetimeApplication->onetimeActionRecord()->update([
                'rejected_at' => now(),
                'assigned_officer_id' => null
            ]);

            $onetimeApplication->onetimeComments()->create([
                'comment_type' => 'officer_to_user',
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => NULL,
                'title' => $request->subject,
                'comment' => $request->body
            ]);

            GlobalMessage::create([
                'department_type' => 'drug',
                'app_type' => 'onetime',
                'app_id' => $onetimeApplication->id,
                'action_type' => 'rejected',
                'user_id' => $onetimeApplication->user_id,
                'subject' => $request->subject,
                'message' => $request->body,
                'redirect_url' => ''
            ]);

            $onetimeApplication->frontendUser->notify(
                new Rejection($onetimeApplication, $request->subject, $request->body)
            );

        });
 
        return $this->jsonResponse('success', "Successfully rejected for " . $onetimeApplication->application_no, request('redirectUrl'));

    }


}
