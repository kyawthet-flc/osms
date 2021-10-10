<?php

namespace App\Http\Controllers\Task\Diac;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Task\Diac\{
    DiacApplication,
    DiacIncomplete
};

use App\Model\Task\DdgDecisionHistory;

use DateTime;
use DB;
use App\User;
use App\Notifications\Diac\{
    AutoCancel,
    Approval,
    Incomplete,
    Rejection
};
use App\Model\Task\Frontend\{
    User as FrontendUser,
    GlobalMessage
};
use App\Model\Task\Attachment;
use App\Model\GeneralSetup\Period;
use App\Model\AccountSetup\RoleUser;
use App\Templates\Diac\Certificate as DiacCertificate;
use App\Http\Requests\ProductSetup\Diac\CommentRequest;

class ActionController extends Controller
{
    protected $applicationModuleId = 1;

    public function comment(CommentRequest $request, DiacApplication $diacApplication)
    {
        DB::transaction(function () use(&$request, &$diacApplication){
            $diacApplication->diacActionRecord()->update(['assigned_officer_id' => $request['officer_id'] ]);

            $diacComment = $diacApplication->diacComments()->create([
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => $request->officer_id,
                'comment' => $request->body
            ]);            
 
        });

        $officerName = User::findOrFail($request->officer_id)->name;
        return $this->jsonResponse('success', "Successfully sent to ". $officerName, request('redirectUrl'));
    }

    public function incomplete(Request $request, DiacApplication $diacApplication)
    {
        if( $diacApplication->application_status === 'incomplete') {
            return $this->jsonResponse(
                "error", "Already made Incomplete.", request('redirectUrl')?? url()->previous()
            );
        }
        $request->validate([ 'subject' => 'required', 'body' => 'required' ]);

        $incompleteAttachments = json_decode(request('incompleteAttachments', null), true)?? [];

        DB::transaction(function () use(&$request, &$diacApplication, &$incompleteAttachments){

            $diacActionRecord = $diacApplication->diacActionRecord;
            
            $versionNo = 1;

            if ( $last = $diacApplication->incompletes()->where('status', 'inactive')->latest()->first() ) {
                $versionNo = $last->version_no + 1;
            }

            if( count($incompleteAttachments) > 0 ) {
                foreach ($incompleteAttachments as $k => $incompleteAttachment) {
                    DiacIncomplete::create([
                        'diac_application_id' => $diacApplication->id,
                        'file_code' => $incompleteAttachment['file_code'],
                        'comment' => $incompleteAttachment['comment'],
                        'version_no' => $versionNo
                    ]);
                }
            } else {
                DiacIncomplete::create([
                    'diac_application_id' => $diacApplication->id,
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

            if ( is_null($diacActionRecord->incomplete_at) ) {
                $diacActionRecord->update(['incomplete_at' => now() ]);
            }

            $diacActionRecord->update(['assigned_officer_id' => NULL ]);

            $diacApplication->update(['application_status' => 'incomplete']);
          
            GlobalMessage::create([
                'department_type' => 'drug',
                'app_type' => 'diac',
                'app_id' => $diacApplication->id,
                'action_type' => 'incomplete',
                'user_id' => $diacApplication->user_id,
                'subject' => $request->subject,
                'message' => $request->body,
                'redirect_url' => ''
            ]);

            $diacApplication->diacComments()->create([
                'comment_type' => 'officer_to_user',
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => NULL,
                'title' => $request->subject,
                'comment' => $request->body
            ]);
 
            // Email to User
            $diacApplication->frontendUser->notify(new Incomplete($diacApplication, $request->subject, $request->body));

            // Remember Incomplet Count
            $diacActionRecord->increment('incomplete_counter', 1);

        });

        // return back()->with('success', "Successfully made Incomplete.");
        return $this->jsonResponse(
            "success", "Successfully made Incomplete.", request('redirectUrl')?? url()->previous()
        );
    }

    public function autoCancel(Request $request, DiacApplication $diacApplication)
    {
        try {
            
            $validated = $request->validate(['subject' => 'required', 'body' => 'required']);
 
            $diacApplication->diacComments()->create([
                'comment_type' => 'officer_to_user',
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => NULL,
                'title' => $request->subject,
                'comment' => $request->body
            ]);

            $diacApplication->diacActionRecord()->update([
                'auto_cancelled_at' => now(),
                'assigned_officer_id' => NULL
            ]);

            GlobalMessage::create([
                'department_type' => 'drug',
                'app_type' => 'diac',
                'app_id' => $diacApplication->id,
                'action_type' => 'auto-cancelled',
                'user_id' => $diacApplication->user_id,
                'subject' => $request->subject,
                'message' => $request->body,
                'redirect_url' => ''
            ]);
 
            $diacApplication->update(['application_status' => 'auto-cancelled']);

            // Emailing to User
            $diacApplication->frontendUser->notify(new AutoCancel($diacApplication, $request->body));

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
    public function toApprove(Request $request, DiacApplication $diacApplication)
    {
        if(  $this->processDgOrDDGAction($diacApplication->id, 'to-approve', $request->body, RoleUser::getDirectorId()) ) {
            return $this->jsonResponse('success', "Successfully Approved.", request('redirectUrl'));
        }

        return $this->jsonResponse('error', 'Error!Please Try again!', request('redirectUrl'));
    }

    public function toReject(Request $request, DiacApplication $diacApplication)
    {
        if(  $this->processDgOrDDGAction($diacApplication->id, 'to-reject', $request->body, RoleUser::getDirectorId()) ) {
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

            if( $diacApplication = DiacApplication::find($caseId) ) {

                // To record DDG or DG action records
                DdgDecisionHistory::create(array(
                    'application_module_id' => $diacApplication->application_module_id,
                    'application_id' => $diacApplication->id,
                    'user_id' => auth()->user()->id,
                    'ts_code' => date('YmdHis'),
                    'action_name' =>   in_array($actionType, ['to-approve', 'to-approve-all'])? 'approve': 'reject',
                    'action_type' =>   in_array($actionType, ['to-approve', 'to-reject'])? 'individual': 'group'
                ));
         
                $diacApplication->diacComments()->create([
                    'from_officer_id' => auth()->user()->id,
                    'to_officer_id' => $toOfficerId,
                    'title' => $title,
                    'comment' => $comment
                ]);
        
                $diacApplication->diacActionRecord()->first()->update([
                    'assigned_officer_id' => $toOfficerId, 
                    'decision_status' => $decisionStatus
                ]);

                return true;
            } 

            return false;

        });
    }

    public function previewRejection(Request $request, DiacApplication $diacApplication)
    {
    }
    
    public function previewCertificate(Request $request, DiacApplication $diacApplication)
    {
        return (new DiacCertificate($diacApplication))->generate();
    }

    public function approve(Request $request, DiacApplication $diacApplication)
    {
        if( $diacApplication->diacActionRecord->decision_status === 'rejectable') {
            return $this->jsonResponse('error', "This application is to be approved.", request('redirectUrl'));
        }

        $validated = $request->validate(['subject' => 'required', 'body' => 'required']);

        DB::transaction(function () use(&$request, &$diacApplication){

            $certificateFileId = null;
            
            if($diacApplication->application_type == 'new'){
                
                //calculate expire date start
                $date = new DateTime('now'); 
                $date->modify('+' . (new Period)->validity($this->applicationModuleId, $diacApplication->application_type));
                $date->modify('-1 day');
                $date = $date->format('Y-m-d');

                $diacApplication->update([
                    'expire_date' => $date, 
                    'issue_date' => date("Y-m-d"), 
                    'application_status' => 'approved'
                ]);

                // this method must be called just after setting expire_date and issue_date
                $diacApplication->generateCertificateNo();

                $template = new DiacCertificate($diacApplication);
                $certificateFileId = $template->save();
            }

            //if renew
            if($diacApplication->application_type == 'renew'){
               
                //change old application to expired when renew is approved
                $diacApplication->parentDiacApplication()->update(['application_status' => 'expired']);

                //calculate expire date start
              
                $expireDate = $diacApplication->is_old_renewal ==='yes' && is_null($diacApplication->parent_id)?
                $diacApplication->expire_date: $diacApplication->parentDiacApplication->expire_date;
                $date = new DateTime($expireDate);
                $date->modify('+' . (new Period)->validity($this->applicationModuleId, $diacApplication->application_type));
                $date->modify('-1 day');
                $date = $date->format('Y-m-d');

                $diacApplication->update([
                    'issue_date' => $expireDate, // the expire date of the last app
                    'expire_date' => $date
                ]);
                
                $diacApplication->generateCertificateNo();

                $template = new DiacCertificate($diacApplication);
                $certificateFileId = $template->save();

            }
            //if amend
            if($diacApplication->application_type == 'amend'){
                
                /* Start Amend Section */
                $amendFields = $diacApplication->diacAmendApplications()->whereNull('sub_relation_type')->pluck('value', 'atrtribute')->toArray();
                $supervisingPersonAmends = $diacApplication->diacAmendApplications()->where('sub_relation_type','supervising_person')->get()->groupBy('sub_relation_id');
                foreach($supervisingPersonAmends??[] as $spId => $data){
                    // dd($data->pluck('value', 'atrtribute'), $spId);
                    $data = $data->pluck('value', 'atrtribute');
                    $diacApplication->diacSupervisingPeople()->whereId($spId)->update([
                        'name' => $data['new_name']?? $data['name'],
                        'qualification' => $data['new_qualification']?? $data['qualification'],
                        'duties' => $data['new_duties']?? $data['duties']
                    ]);
                }

                $diacApplication->update([
                    'business_name' => $amendFields['new_business_name']?? $diacApplication->business_name,
                    'business_address' => $amendFields['new_business_address']?? $diacApplication->business_address,
                    'applicant_name' => $amendFields['new_applicant_name']?? $diacApplication->applicant_name,
                    'place_of_storage' => $amendFields['new_place_of_storage']?? $diacApplication->place_of_storage
                ]);
                /* Amend Section */
                
                $diacApplication->parentDiacApplication()->update(['application_status' => 'expired']);
                $diacApplication->update([
                    'issue_date' => $diacApplication->parentDiacApplication->issue_date,
                    'expire_date' => $diacApplication->parentDiacApplication->expire_date
                ]);
                $template = new DiacCertificate($diacApplication);
                $certificateFileId = $template->save();                
            }

            $diacApplication->update(['application_status' => 'approved']);
            $diacApplication->diacActionRecord()->update([
                'certificate_file_id' => $certificateFileId,
                'approved_at' => now()
            ]);

            $diacApplication->diacComments()->create([
                'comment_type' => 'officer_to_user',
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => NULL,
                'title' => $request->subject,
                'comment' => $request->body
            ]);

            GlobalMessage::create([
                'department_type' => 'drug',
                'app_type' => 'diac',
                'app_id' => $diacApplication->id,
                'action_type' => 'approved',
                'user_id' => $diacApplication->user_id,
                'subject' => $request->subject,
                'message' => $request->body,
                'redirect_url' => ''
            ]);

           $diacApplication->frontendUser->notify(new Approval($diacApplication, $request->subject, $request->body));

        });
 
        return $this->jsonResponse('success', "Successfully approved for " . $diacApplication->application_no, request('redirectUrl'));
    }

    public function reject(Request $request, DiacApplication $diacApplication)
    {
        if( $diacApplication->diacActionRecord->decision_status === 'approvable') {
            return $this->jsonResponse('error', "This application is to be rejected.", request('redirectUrl'));
        }
        
        $validated = $request->validate(['subject' => 'required', 'body' => 'required']);

        DB::transaction(function () use(&$request, &$diacApplication){

            $now = now();

            $diacApplication->update([
                'application_status' => 'rejected'
            ]);

            $diacApplication->diacActionRecord()->update([
                'rejected_at' => now(),
                'assigned_officer_id' => null
            ]);

            $diacApplication->diacComments()->create([
                'comment_type' => 'officer_to_user',
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => NULL,
                'title' => $request->subject,
                'comment' => $request->body
            ]);

            GlobalMessage::create([
                'department_type' => 'drug',
                'app_type' => 'diac',
                'app_id' => $diacApplication->id,
                'action_type' => 'rejected',
                'user_id' => $diacApplication->user_id,
                'subject' => $request->subject,
                'message' => $request->body,
                'redirect_url' => ''
            ]);

            $diacApplication->frontendUser->notify(new Rejection($diacApplication, $request->subject, $request->body));

        });
 
        return $this->jsonResponse('success', "Successfully rejected for " . $diacApplication->application_no, request('redirectUrl'));

    }


}
