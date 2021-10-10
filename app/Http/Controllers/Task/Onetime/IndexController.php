<?php

namespace App\Http\Controllers\Task\Onetime;

use Illuminate\Http\Request;
use App\Model\Task\Attachment;

use App\Http\Controllers\Controller;

use App\Model\File;
use App\Model\Task\Onetime\OnetimeApplication;
use App\Model\Task\Onetime\OnetimeActionRecord;
// use App\Model\Task\Onetime\OnetimeApplication;
// use App\Model\Task\Attachment;
// use App\Model\File;

class IndexController extends Controller
{
    protected $basePath = 'enforcements.tasks.onetime.';
    /*
    * Get all my tasks  
    */
    public function index()
    {
        $isMyTask = request('taskType', 'myTasks') === 'myTasks';
        $applicationStatus = request('applicationStatus', 'submitted');
        $applicationType = request('applicationType', 'new');
   
        $lists = OnetimeApplication::with([
            'onetimeActionRecord',
            'ddgDecisionHistory',
            'onetimeActionRecord.user',
            'onetimeComments'
        ])
        ->where(function($q) use (&$isMyTask, &$applicationStatus) {
            if( 'recentDecision' !== request('taskType') ) {
                $q->where('application_status', $applicationStatus);
            }
        })
        ->where('application_type', $applicationType)
        ->whereHas('onetimeActionRecord', function($q) use (&$isMyTask, &$applicationStatus) {

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
        ->whereHas('onetimeProductLists', function($q){
            return $q->where('brand_name', 'like', '%'.request('brand_name').'%');
        })
        ->applicationNo(request('application_no'))
        ->paginate();

        $this->data = array(
            'cardTitle' => 'Onetime '.ucfirst($applicationType).' Application',
            'title' => 'Onetime',
            'lists' => $lists
        );

        return $this->viewPath('list.index');
    }

    public function show(OnetimeApplication $onetimeApplication)
    {
        $this->data = array(
            'cardTitle' => 'Onetime Application',
            'title' => 'Onetime',
            'application' => $onetimeApplication
        );
        return $this->viewPath('detail.show');
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
