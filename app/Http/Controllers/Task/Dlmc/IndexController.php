<?php

namespace App\Http\Controllers\Task\Dlmc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Task\Dlmc\DlmcApplication;
use App\Model\Task\Attachment;
use App\Model\File;

class IndexController extends Controller
{
    protected $basePath = 'enforcements.tasks.dlmc.';
    protected $applicationModuleId = 4;

    /*
    * Get all my tasks  
    */
    public function index()
    {
        $isMyTask = request('taskType', 'myTasks') === 'myTasks';
        $applicationStatus = request('applicationStatus', 'submitted');
        $applicationType = request('applicationType', 'new');

        $lists = DlmcApplication::with([
            'dlmcActionRecord',
            'dlmcDrugsToProduce',
            'inspections',
            'dlmcActionRecord.user',
            'dlmcComments'
        ])
        ->where('application_type', $applicationType)
        ->whereHas('dlmcActionRecord', function($q) use (&$isMyTask, &$applicationStatus) {
            $q->submittedAt(request('submitted_at'))
                ->resubmittedAt(request('resubmitted_at'))
                ->incompleteAt(request('incomplete_at'))
                ->autoCancelledAt(request('auto_cancelled_at'))
                ->rejectedAt(request('rejcted_at'))
                ->tempLicenseAt(request('temp_license_at'))
                ->approvedAt(request('approved_at'))
                ->where('application_status', $applicationStatus);

            if( $isMyTask && in_array($applicationStatus,['resubmitted','submitted', 'license-approved']) ) {
                if (auth()->user()->isDirector()) {
                    return $q->where('assigned_officer_id', auth()->user()->id)
                    ->whereNull('decision_status');
                } else {
                    return $q->where('assigned_officer_id', auth()->user()->id);

                }
            }
            if ( auth()->user()->isDirector() && request('taskType') === 'returnFromDG' ) {
                return $q->where('assigned_officer_id', auth()->user()->id)->whereIn('decision_status', ['approvable', 'rejectable']);
            }elseif ((auth()->user()->isDeputyDirectorGeneral() || auth()->user()->isDirectorGeneral()) && request('taskType') === 'returnFromDG') // this recent query in dg
            {
                // 4 is director id
                return $q->where('assigned_officer_id', 4)->whereIn('decision_status', ['approvable', 'rejectable']);
            }
        })
        ->whereDoesntHave('inspections', function($q)  use (&$isMyTask){ 
            if($isMyTask)
            {
                $q->whereIn('status', ['inspect', 'send', 'submitted', 'incomplete']);
            }else
            {
                $q->whereNull('status');
            }
        })
        ->whereHas('dlmcDrugsToProduce', function ($qry) {
            $qry->dosageType(request('dosage_type'));
        })
        ->certificateNo(request('certificate_no'))
        ->applicationNo(request('application_no'))
        ->manufName(request('manufacturer_name'))
        ->orderBy(request('order_by', 'application_no'), request('direction', 'desc'))
        ->paginate(10);

        $this->data = array(
            'cardTitle' => 'DLMC '.ucfirst($applicationType).' Application',
            'title' => 'DLMC',
            'lists' => $lists
        );

        return $this->viewPath('list.index');
    }

    public function show(DlmcApplication $dlmcApplication)
    {

        $this->data = array(
            'cardTitle' => 'DLMC Application',
            'title' => 'DLMC',
            'application' => $dlmcApplication
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
