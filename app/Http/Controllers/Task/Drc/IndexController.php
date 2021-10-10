<?php

namespace App\Http\Controllers\Task\Drc;

use App\Http\Controllers\Controller;
use App\Model\File;
use App\Model\Task\Drc\DrcApplication;
use Illuminate\Http\Request;
use App\Model\Task\Attachment;

class IndexController extends Controller
{
    protected $basePath = 'enforcements.tasks.drc.';
    protected $applicationModuleId = 2;
    /*
    * Get all my tasks
    */
    public function index()
    {
        $isMyTask = request('taskType', 'myTasks') === 'myTasks';
        $applicationStatus = request('applicationStatus', 'submitted');
        $applicationType = request('applicationType', 'new');

        $lists = DrcApplication::with([
            'drcActionRecord',
            'drcActionRecord.user',
            'drcComments'
        ])
        ->where('application_module_id', $this->applicationModuleId)
        ->where('application_status', $applicationStatus)
        ->where('application_type', $applicationType)
        ->registrationFee(request('registration_fee'))
        ->applicationNo(request('application_no'))
        ->whereHas('drcActionRecord', function($q) use (&$isMyTask,&$applicationStatus) {
            $q->submittedAt(request('submitted_at'))
                ->resubmittedAt(request('resubmitted_at'))
                ->incompleteAt(request('incomplete_at'))
                ->autoCancelledAt(request('auto_cancelled_at'))
                ->rejectedAt(request('rejceted_at'))
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
                    // dd(request('createdAt', date('Y-m-d')));
                    return $q->where('user_id', auth()->user()->id)->createdAt(request('createdAt', date('Y-m-d')));
                });
            }
        })
        ->orderBy(request('orderBy','application_serial'), request('direction','desc'))
        ->paginate();

        $this->data = array(
            'cardTitle' => 'DRC '.ucfirst($applicationType).' Application',
            'title' => 'DRC',
            'lists' => $lists
        );

        return $this->viewPath('list.index');
    }

    public function show(DrcApplication $drcApplication)
    {
        // dd($diacApplication);
        $this->data = array(
            'cardTitle' => 'DRC Application',
            'title' => 'DRC',
            'application' => $drcApplication
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
