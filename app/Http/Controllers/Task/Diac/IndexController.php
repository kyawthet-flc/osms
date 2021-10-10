<?php

namespace App\Http\Controllers\Task\Diac;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Task\Diac\{ DiacApplication, DiacDrugToImport };
use App\Model\Task\Attachment;
use App\Model\File;

class IndexController extends Controller
{
    protected $basePath = 'enforcements.tasks.diac.';
    /*
    * Get all my tasks  
    */
    public function index()
    {
        $isMyTask = request('taskType', 'myTasks') === 'myTasks';
        $applicationStatus = request('applicationStatus', 'submitted');
        $applicationType = request('applicationType', 'new');
        $hasExtension = request('hasExtension', 'no');

        $lists = DiacApplication::with([
            'diacActionRecord',
            'ddgDecisionHistory',
            'diacActionRecord.user',
            'diacComments'
        ])
        ->where(function($q) use (&$isMyTask, &$applicationStatus) {
            if( 'recentDecision' !== request('taskType') ) {
                $q->where('application_status', $applicationStatus);
            }
        }) 
        ->where('application_type', $applicationType)
        ->where('has_extension', $hasExtension)
        ->where(function($q){
            if( request('is_old_renewal') ) {
                return $q->where('is_old_renewal', request('is_old_renewal'));
            }
        })
        ->whereHas('diacActionRecord', function($q) use (&$isMyTask, &$applicationStatus) {

            $q->submittedAt(request('submitted_at'))
                ->resubmittedAt(request('resubmitted_at'))
                ->incompleteAt(request('incomplete_at'))
                ->autoCancelledAt(request('auto_cancelled_at'))
                ->rejectedAt(request('rejcted_at'))
                ->approvedAt(request('approved_at'));

            if( $isMyTask && in_array($applicationStatus,['resubmitted','submitted']) ) {
                if (auth()->user()->isDirector()) {
                    return $q->where('assigned_officer_id', auth()->user()->id)->whereNull('decision_status');
                } else {
                    return $q->where('assigned_officer_id', auth()->user()->id);
                }
            }
            if ( auth()->user()->isDirector() && request('taskType') === 'returnFromDG' ) {
                $q->where('assigned_officer_id', auth()->user()->id)->whereIn('decision_status', ['approvable', 'rejectable']);
            }
        })
        ->where(function($q){
            if( 'recentDecision' === request('taskType') ) {
                return $q->whereHas('ddgDecisionHistory', function($q){
                    return $q->where('user_id', auth()->user()->id)->createdAt(request('createdAt', date('Y-m-d')));
                });
            }
        })
        ->orderBy(request('orderBy', 'application_serial'), request('direction', 'desc'))
        ->businessName(request('business_name'))
        ->applicationNo(request('application_no'))
        ->paginate();

        $this->data = array(
            'cardTitle' => 'DIAC '.ucfirst($applicationType).' Application',
            'title' => 'DIAC',
            'lists' => $lists
        );

        return $this->viewPath('list.index');
    }

    public function show(DiacApplication $diacApplication)
    {
        // dd($diacApplication);
        $this->data = array(
            'cardTitle' => 'DIAC Application',
            'title' => 'DIAC',
            'application' => $diacApplication
        );

        return $this->viewPath('detail.show');
    }

    public function addDrugToImportToApproveList(DiacApplication $diacApplication, DiacDrugToImport $diacDrugToImport)
    { 
        if( $diacDrugToImport->update(['is_selected' => request('selected')]) ) {
            if ( request('selected') == 'yes') {
                return $this->jsonResponse('success', "Successfully added to Approved List", "#");
            }
            return $this->jsonResponse('success', "Successfully removed from Approved List", "#");
        }
        return $this->jsonResponse('error', "Something went wrong!", "#");
    }

    public function showDocument(Attachment $attachment)
    {
        return $attachment->showFile();
    }

    public function viewApprovedCertificate(File $file)
    {
        return $file->showFile();
    }

    

}
