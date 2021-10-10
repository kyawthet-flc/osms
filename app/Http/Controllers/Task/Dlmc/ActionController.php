<?php

namespace App\Http\Controllers\Task\Dlmc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Task\Dlmc\{DlmcApplication, DlmcIncomplete, Inspection};
use App\Model\Task\DdgDecisionHistory;
use App\Model\Task\Attachment as DrugAttachment;
use DateTime;
use DB;
use App\User;
use App\Notifications\Dlmc\{
    AutoCancel,
    Approval,
    Incomplete,
    Rejection,
    PayRegsterFee,
    InspectionNotic
};
use App\Model\Task\Frontend\{
    User as FrontendUser,
    GlobalMessage
};
use App\Model\GeneralSetup\Period;
use App\Model\AccountSetup\RoleUser;
use App\Templates\Dlmc\Certificate as DlmcCertificate;
use App\Templates\Dlmc\TempLicense;
use App\Http\Requests\ProductSetup\Diac\CommentRequest;
class ActionController extends Controller
{
    protected $applicationModuleId = 4;

    public function comment(CommentRequest $request, DlmcApplication $dlmcApplication)
    {
        DB::transaction(function () use(&$request, &$dlmcApplication){
            $dlmcApplication->dlmcActionRecord()->update(['assigned_officer_id' => $request['officer_id'] ]);

            $dlmcComment = $dlmcApplication->dlmcComments()->create([
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => $request->officer_id,
                'comment' => $request->body
            ]);            
 
        });

        $officerName = User::findOrFail($request->officer_id)->name;
        return $this->jsonResponse('success', "Successfully sent to ". $officerName, request('redirectUrl'));
    }

    public function makePayment(Request $request, DlmcApplication $dlmcApplication)
    {
        DB::transaction(function () use(&$request, &$dlmcApplication){

            $validated = $request->validate(['subject' => 'required', 'amount' => 'required', 'body' => 'required']);
            
            $dlmcApplication->update([
                'payment_status' => 'pay',
                'registration_fee' => $request->amount,
                'payment_remark' => $request->body,
            ]);

            $dlmcApplication->dlmcActionRecord()->update([
                'pay_second_at' => now(),
                // 'assigned_officer_id' => NULL
            ]);

            GlobalMessage::create([
                'department_type' => 'drug',
                'app_type' => 'dlmc',
                'app_id' => $dlmcApplication->id,
                'action_type' => 'payable',
                'user_id' => $dlmcApplication->user_id,
                'subject' => $request->subject,
                'message' => $request->body,
                'redirect_url' => ''
            ]);

            $dlmcApplication->dlmcComments()->create([
                'comment_type' => 'officer_to_user',
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => NULL,
                'title' => $request->subject,
                'comment' => $request->body
            ]);

            // Email to User
            $dlmcApplication->frontendUser->notify(new PayRegsterFee($dlmcApplication, $request->body));
 
        });

        return $this->jsonResponse(
            "success", "Successfully made Registration Payment.", request('redirectUrl')?? url()->previous()
        );
    }

    public function inspectionNotice(Request $request, DlmcApplication $dlmcApplication)
    {
        DB::transaction(function () use(&$request, &$dlmcApplication){

            $validated = $request->validate(['subject' => 'required', 'body' => 'required']);

            $inspection = Inspection::create([
                'dlmc_application_id' => $dlmcApplication->id,
                'to_user_id' => $dlmcApplication->user_id,
                'comment' => $request->body,
                'status' => 'inspect',
            ]);

            if(request()->has('inspectionFiles'))
            {
                foreach($request->inspectionFiles??[] as $file) {
                    
                    $uploadFile = array_merge(
                        (new DrugAttachment)->extractFileInfo("drug", $file, date('d-m-Y'). "/dlmc", 'inspection-file'),
                        [
                            'application_module_id' => $this->applicationModuleId,
                            'application_type' => $dlmcApplication->application_type,
                            'sub_app_type' => 'inspection_notice',
                            'version_no' => '',
                        ]
                    );
                    $inspection->drugAttachments()->create($uploadFile);
                }
            }

            GlobalMessage::create([
                'department_type' => 'drug',
                'app_type' => 'dlmc',
                'app_id' => $dlmcApplication->id,
                'action_type' => 'inspection',
                'user_id' => $dlmcApplication->user_id,
                'subject' => $request->subject,
                'message' => $request->body,
                'redirect_url' => ''
            ]);

            $dlmcApplication->dlmcComments()->create([
                'comment_type' => 'officer_to_user',
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => NULL,
                'title' => $request->subject,
                'comment' => $request->body
            ]);

            // Email to User
            $dlmcApplication->frontendUser->notify(new InspectionNotic($dlmcApplication, $request->body));

            // Remember Inspection Count
            $dlmcApplication->dlmcActionRecord()->increment('inspection_counter', 1);
 
        });

        return $this->jsonResponse(
            "success", "Successfully made Inspection Notice.", request('redirectUrl')?? url()->previous()
        );
    }

    public function incomplete(Request $request, DlmcApplication $dlmcApplication)
    {
        if( $dlmcApplication->application_status === 'incomplete') {
            return $this->jsonResponse(
                "error", "Already made Incomplete.", request('redirectUrl')?? url()->previous()
            );
        }
        $request->validate([ 'subject' => 'required', 'body' => 'required' ]);

        $incompleteAttachments = json_decode(request('incompleteAttachments', null), true)?? [];

        DB::transaction(function () use(&$request, &$dlmcApplication, &$incompleteAttachments){

            $dlmcActionRecord = $dlmcApplication->dlmcActionRecord;
            
            $versionNo = 1;

            if ( $last = $dlmcApplication->incompletes()->where('status', 'inactive')->latest()->first() ) {
                $versionNo = $last->version_no + 1;
            }

            foreach ($incompleteAttachments as $k => $incompleteAttachment) {
                DlmcIncomplete::create([
                    'dlmc_application_id' => $dlmcApplication->id,
                    'file_code' => $incompleteAttachment['file_code'],
                    'comment' => $incompleteAttachment['comment'],
                    'version_no' => $versionNo
                ]);
            }            

            /* $date = new DateTime('now');
            $date->modify( GeneralSetup::incompleteAutocancelPeroid(
                $this->appCode, $applicationCase->MdeviceApplication->type
            )); //+3months of current date
            $date = $date->format('Y-m-d'); */

            if ( is_null($dlmcActionRecord->incomplete_at) ) {
                $dlmcActionRecord->update(['incomplete_at' => now() ]);
            }

            // $dlmcActionRecord->update(['assigned_officer_id' => NULL ]);

            $dlmcApplication->update(['application_status' => 'incomplete']);
          
            GlobalMessage::create([
                'department_type' => 'drug',
                'app_type' => 'dlmc',
                'app_id' => $dlmcApplication->id,
                'action_type' => 'incomplete',
                'user_id' => $dlmcApplication->user_id,
                'subject' => $request->subject,
                'message' => $request->body,
                'redirect_url' => ''
            ]);

            $dlmcApplication->dlmcComments()->create([
                'comment_type' => 'officer_to_user',
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => NULL,
                'title' => $request->title,
                'comment' => $request->body
            ]);
 
            // Email to User
            $dlmcApplication->frontendUser->notify(new Incomplete($dlmcApplication, $request->body));

            // Remember Incomplet Count
            $dlmcActionRecord->increment('incomplete_counter', 1);

        });

        // return back()->with('success', "Successfully made Incomplete.");
        return $this->jsonResponse(
            "success", "Successfully made Incomplete.", request('redirectUrl')?? url()->previous()
        );
    }

    public function autoCancel(Request $request, DlmcApplication $dlmcApplication)
    {
        try {
            
            $validated = $request->validate(['subject' => 'required', 'body' => 'required']);
 
            $dlmcApplication->dlmcComments()->create([
                'comment_type' => 'officer_to_user',
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => NULL,
                'title' => $request->title,
                'comment' => $request->body
            ]);

            $dlmcApplication->dlmcActionRecord()->update([
                'auto_cancelled_at' => now(),
                'assigned_officer_id' => NULL
            ]);

            GlobalMessage::create([
                'department_type' => 'drug',
                'app_type' => 'dlmc',
                'app_id' => $dlmcApplication->id,
                'action_type' => 'auto-cancelled',
                'user_id' => $dlmcApplication->user_id,
                'subject' => $request->title,
                'message' => $request->body,
                'redirect_url' => ''
            ]);
 
            $dlmcApplication->update(['application_status' => 'auto-cancelled']);

            // Emailing to User
            $dlmcApplication->frontendUser->notify(new AutoCancel($dlmcApplication, $request->body));

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
    public function toApprove(Request $request,DlmcApplication $dlmcApplication)
    {
        if(  $this->processDgOrDDGAction($dlmcApplication->id, 'to-approve', $request->body, RoleUser::getDirectorId()) ) {
            return $this->jsonResponse('success', "Successfully Approved.", request('redirectUrl'));
        }

        return $this->jsonResponse('error', 'Error!Please Try again!', request('redirectUrl'));
    }

    public function toReject(Request $request, DlmcApplication $dlmcApplication)
    {
        if(  $this->processDgOrDDGAction($dlmcApplication->id, 'to-reject', $request->body, RoleUser::getDirectorId()) ) {
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

            if( $dlmcApplication = DlmcApplication::find($caseId) ) {

                // To record DDG or DG action records
                // DdgDecisionHistory::create(array(
                //     'application_module_id' => $dlmcApplication->application_module_id,
                //     'application_id' => $dlmcApplication->id,
                //     'user_id' => auth()->user()->id,
                //     'ts_code' => date('YmdHis'),
                //     'action_name' =>   in_array($actionType, ['to-approve', 'to-approve-all'])? 'approve': 'reject',
                //     'action_type' =>   in_array($actionType, ['to-approve', 'to-reject'])? 'individual': 'group'
                // ));
         
                $dlmcApplication->dlmcComments()->create([
                    'from_officer_id' => auth()->user()->id,
                    'to_officer_id' => $toOfficerId,
                    'title' => $title,
                    'comment' => $comment
                ]);
        
                $dlmcApplication->dlmcActionRecord()->first()->update([
                    'assigned_officer_id' => $toOfficerId, 
                    'decision_status' => $decisionStatus
                ]);

                return true;
            } 

            return false;

        });
    }

    public function previewRejection(Request $request, DlmcApplication $dlmcApplication)
    {
    }
    
    public function previewCertificate(Request $request, DlmcApplication $dlmcApplication)
    {
        return (new DlmcCertificate($dlmcApplication))->generate();
    }

    public function previewLicense(Request $request, DlmcApplication $dlmcApplication)
    {
        return (new TempLicense($dlmcApplication))->generate();
    }

    public function approveLicense(Request $request, DlmcApplication $dlmcApplication)
    {
        if( $dlmcApplication->dlmcActionRecord->decision_status === 'rejectable') {
            return $this->jsonResponse('error', "This application is to be approved.", request('redirectUrl'));
        }
        
        $validated = $request->validate(['subject' => 'required', 'body' => 'required']);

        DB::transaction(function () use(&$request, &$dlmcApplication){

            //calculate expire date start
            $date = new DateTime('now'); 
            $date->modify('+' . (new Period)->validityTempLicense($this->applicationModuleId, $dlmcApplication->application_type));
            $date->modify('-1 day');
            $date = $date->format('Y-m-d');

            $dlmcApplication->update([
                'temp_expire_date' => $date, 
                'temp_issue_date' => date("Y-m-d"), 
                'application_status' => 'license-approved'
            ]);

            $template = new TempLicense($dlmcApplication);
            $tempLicenseFileId = $template->save();

            $dlmcApplication->dlmcActionRecord()->update([
                'temp_license_file_id' => $tempLicenseFileId,
                'assigned_officer_id' => NULL,
                'decision_status' => Null,
                'temp_license_at' => now(),
            ]);

            $dlmcApplication->dlmcComments()->create([
                'comment_type' => 'officer_to_user',
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => NULL,
                'title' => $request->subject,
                'comment' => $request->body
            ]);

            GlobalMessage::create([
                'department_type' => 'drug',
                'app_type' => 'dlmc',
                'app_id' => $dlmcApplication->id,
                'action_type' => 'approved',
                'user_id' => $dlmcApplication->user_id,
                'subject' => $request->subject,
                'message' => $request->body,
                'redirect_url' => ''
            ]);
        });
 
        return $this->jsonResponse('success', "Successfully Temporary License Approved for " . $dlmcApplication->application_no, request('redirectUrl'));
    }

    public function approve(Request $request, DlmcApplication $dlmcApplication)
    {
        if( $dlmcApplication->dlmcActionRecord->decision_status === 'rejectable') {
            return $this->jsonResponse('error', "This application is to be approved.", request('redirectUrl'));
        }

        $validated = $request->validate(['subject' => 'required', 'body' => 'required']);

        DB::transaction(function () use(&$request, &$dlmcApplication){

            $certificateFileId = null;
            
            if($dlmcApplication->application_type == 'new'){

                // this method must be called just after setting expire_date and issue_date
                $dlmcApplication->generateCertificateNo();
                
                //calculate expire date start
                $date = new DateTime('now'); 
                $date->modify('+' . (new Period)->validity($this->applicationModuleId, $dlmcApplication->application_type));
                $date->modify('-1 day');
                $date = $date->format('Y-m-d');

                $dlmcApplication->update([
                    'expire_date' => $date, 
                    'issue_date' => date("Y-m-d"), 
                    'application_status' => 'approved'
                ]);

                $template = new DlmcCertificate($dlmcApplication);
                $certificateFileId = $template->save();
            }

            //if renew
            if($dlmcApplication->application_type == 'renew'){
               
                $dlmcApplication->generateCertificateNo();
                //change old application to expired when renew is approved
                $dlmcApplication->parentdlmcApplication()->update(['application_status' => 'expired']);

                //calculate expire date start
                $date = new DateTime($dlmcApplication->parentdlmcApplication->expire_date);
                $date->modify('+' . (new Period)->validity($this->applicationModuleId, $dlmcApplication->application_type));
                $date->modify('-1 day');
                $date = $date->format('Y-m-d');

                $dlmcApplication->update([
                    'issue_date' => $dlmcApplication->parentdlmcApplication->expire_date, // the expire date of the last app
                    'expire_date' => $date
                ]);

                $template = new DlmcCertificate($dlmcApplication);
                $certificateFileId = $template->save();

            }
            //if amend
            if($dlmcApplication->application_type == 'amend'){
                $dlmcApplication->parentdlmcApplication()->update(['application_status' => 'expired']);
                $dlmcApplication->update([
                    'issue_date' => $dlmcApplication->parentdlmcApplication->issue_date,
                    'expire_date' => $dlmcApplication->parentdlmcApplication->expire_date
                ]);
                $template = new DlmcCertificate($dlmcApplication);
                $certificateFileId = $template->save();                
            }

            $dlmcApplication->update(['application_status' => 'approved']);
            $dlmcApplication->dlmcActionRecord()->update([
                'certificate_file_id' => $certificateFileId,
                'approved_at' => now()
            ]);

            $dlmcApplication->dlmcComments()->create([
                'comment_type' => 'officer_to_user',
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => NULL,
                'title' => $request->subject,
                'comment' => $request->body
            ]);

            GlobalMessage::create([
                'department_type' => 'drug',
                'app_type' => 'dlmc',
                'app_id' => $dlmcApplication->id,
                'action_type' => 'approved',
                'user_id' => $dlmcApplication->user_id,
                'subject' => $request->subject,
                'message' => $request->body,
                'redirect_url' => ''
            ]);

           $dlmcApplication->frontendUser->notify(new Approval($dlmcApplication, $request->subject, $request->body));

        });
 
        return $this->jsonResponse('success', "Successfully approved for " . $dlmcApplication->application_no, request('redirectUrl'));
    }

    public function reject(Request $request, DlmcApplication $dlmcApplication)
    {
        if( $dlmcApplication->dlmcActionRecord->decision_status === 'approvable') {
            return $this->jsonResponse('error', "This application is to be rejected.", request('redirectUrl'));
        }
        
        $validated = $request->validate(['subject' => 'required', 'body' => 'required']);

        DB::transaction(function () use(&$request, &$dlmcApplication){

            $now = now();

            $dlmcApplication->update([
                'application_status' => 'rejected'
            ]);

            $dlmcApplication->dlmcActionRecord()->update([
                'rejected_at' => now(),
                'assigned_officer_id' => null
            ]);

            $dlmcApplication->dlmcComments()->create([
                'comment_type' => 'officer_to_user',
                'from_officer_id' => auth()->user()->id,
                'to_officer_id' => NULL,
                'title' => $request->subject,
                'comment' => $request->body
            ]);

            GlobalMessage::create([
                'department_type' => 'drug',
                'app_type' => 'dlmc',
                'app_id' => $dlmcApplication->id,
                'action_type' => 'rejected',
                'user_id' => $dlmcApplication->user_id,
                'subject' => $request->subject,
                'message' => $request->body,
                'redirect_url' => ''
            ]);

            $dlmcApplication->frontendUser->notify(new Rejection($dlmcApplication, $request->subject, $request->body));

        });
 
        return $this->jsonResponse('success', "Successfully rejected for " . $dlmcApplication->application_no, request('redirectUrl'));

    }
   
}
