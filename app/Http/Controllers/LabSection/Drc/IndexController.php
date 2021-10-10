<?php

namespace App\Http\Controllers\LabSection\Drc;

use App\Http\Controllers\Controller;
use App\Model\Task\Drc\{
    DrcApplication,
    DrcActionRecord
};
use Illuminate\Http\Request;
use App\Templates\Lab\Drc\Certificate;
 
// use App\Model\Task\Attachment;


class IndexController extends Controller
{
    protected $basePath = 'lab-sections.drc.';
    /*
    * Get all my tasks
    */
    public function index(Request $request)
    {
        $applicationType = request('applicationType', 'new');

        $lists = DrcApplication::with(['drcActionRecord', 'drcActionRecord.user', 'drcComments'])
        ->whereHas('drcActionRecord', function($q) use (&$isMyTask) {
            $q->labRequestedAt(request('received_at'))
            ->labReceivedAt(request('sent_at'));

            if( in_array(request('labTypeStatus'), ['to_check', 'to_recheck']) ) {
                $q->whereLabStatus('requested');
            } elseif( in_array(request('labTypeStatus'), ['result']) ) {
                $q->whereIn('lab_status', ['passed', 'failed']);
            } elseif( in_array(request('labTypeStatus'), ['result']) ) {
                $q->whereIn('lab_status', ['passed', 'failed']);
            } elseif( in_array(request('labTypeStatus'), ['checked']) ) {
                $q->whereLabStatus('received');
            }

        })
        ->applicationNo(request('application_no'))
        ->genericName(request('generic_name'))
        ->dosageForm(request('dosage_form'))
        ->whereApplicationType($applicationType)
        ->whereApplicationModuleId(request('applicationModuleId'))
        ->paginate();

        // 'to_request','requested','checked','rechecked','received','passed','failed'
        $drcQry = DrcActionRecord::whereHas('drcApplication', function($q) use (&$applicationType) {
            return $q->whereApplicationModuleId(request('applicationModuleId'))
            ->whereApplicationType($applicationType);
        });

        $this->data = array(
            // 'cardTitle' =>  $title,
            'title' => $this->displayAppropriateMsg(request('applicationModuleId'),request('applicationType')),
            'lists' => $lists,
            'applicationModuleId' => request('applicationModuleId'),
            'reqeustedCounter' => $drcQry->whereLabStatus('requested')->count(),
            'checkedCounter' => $drcQry->whereIn('lab_status', ['received'])->count(),
            'resultCounter' => 0//DrcActionRecord::whereIn('lab_status', ['passed', 'failed'])->count()
        );

        return $this->viewPath('index');
    }

    public function printCertificate()
    {
        return (new Certificate())->generate();
    }

    public function displayAppropriateMsg($applicationModuleId, $applicationType)
    {
        if ( $applicationType === 'renew' ) {
            return 2 == $applicationModuleId? 'Renew(Import)': 'Renew(Local)';
        }

        return 2 == $applicationModuleId? 'DRC(Import)': 'DRC(Local)';
 
    }
}
