<?php

namespace App\Http\Controllers\Task\DrcLocal;

use App\Http\Controllers\Controller;
use App\Model\Task\Drc\{
    DrcApplication,
    DrcActionRecord
};
use Illuminate\Http\Request;
use App\Model\Task\Attachment;
use DB;

class LabController extends Controller
{
    protected $applicationModuleId = 3;
    protected $basePath = 'enforcements.tasks.drc-local.';
    /*
    * Get all my tasks
    */
    public function index(Request $request)
    {
        $applicationType = request('applicationType', 'new');

        $lists = DrcApplication::with(['drcActionRecord', 'drcActionRecord.user', 'drcComments'])
        ->where('application_module_id', $this->applicationModuleId)
        ->where('application_type', $applicationType)
        ->whereHas('drcActionRecord', function($q) use (&$isMyTask) {
            if( request('labTypeStatus') == 'to_request') {
                $q->whereLabStatus(request('labTypeStatus'))->orWhereNull('lab_status');
            } elseif( request('labTypeStatus') === 'result' ){
                $q->whereIn('lab_status', ['passed', 'failed']);
            }else {
                $q->whereLabStatus(request('labTypeStatus'));
            }
            if ( request('labStatus') ) {
                $q->whereLabStatus(request('labStatus'));
            }
        })
        ->applicationNo(request('application_no'))->paginate(15);

        $drcLabNavNoti = DB::table('drc_action_records')
        ->join('drc_applications', 'drc_applications.id', '=', 'drc_action_records.drc_application_id')
        ->where('application_module_id', $this->applicationModuleId)
        ->first([DB::raw('
            COUNT(drc_action_records.lab_status) as total_count,
            COUNT(CASE WHEN drc_action_records.lab_status = "to_request" THEN 1 ELSE NULL END) AS to_request_count,
            COUNT(CASE WHEN drc_action_records.lab_status = "requested" THEN 1 ELSE NULL END) AS requested_count,
            COUNT(CASE WHEN drc_action_records.lab_status= "received" THEN 1 ELSE NULL END) AS received_count,
            COUNT(CASE WHEN drc_action_records.lab_status in ("passed","failed") THEN 1 ELSE NULL END) AS result_counter
        ')]);
            
        $this->data = array(
            'cardTitle' => 'DRC Lab',
            'title' => 'DRC Lab',
            'lists' => $lists,
            // 'totalCounter' => $drcLabNavNoti->total_count,
            'toReqeustCounter' => $drcLabNavNoti->to_request_count,
            'reqeustedCounter' => $drcLabNavNoti->requested_count,
            'receivedCounter' => $drcLabNavNoti->received_count,
            'resultCounter' => $drcLabNavNoti->result_counter
        );

        return $this->viewPath('lab.index');
    }

    public function show(Request $request, DrcApplication $drcApplication)
    {
        // 'to_request','requested','checked','rechecked','received','passed','failed'
        $this->data = array(
            'drcApplication' => $drcApplication,
            'labResult' => $drcApplication->labResult
        ); 

        return $this->viewPath('lab.show');
    }

    public function resutRequestForm(DrcApplication $drcApplication)
    {
        return $this->jsonResponse(
            'success', 'Successfully Loaded.', '#', ['view' => view($this->basePath . 'lab.result-request-form')->with(['drcApplication' => $drcApplication])->render()]
        );
    }

    public function sendResultRequestForm(Request $request, DrcApplication $drcApplication)
    {
        $request->validate(['application_no' => 'required','application_date' => 'required' ]);

        $isProcessedMsg = DB::transaction(function() use (&$request, &$drcApplication) {

            $msg = NULL;
            if( 'send-lab-result-request' === $request->actionType) {
                $drcApplication->drcActionRecord->update(['lab_status' => 'requested', 'lab_requested_at' => now() ]);
                $msg = 'Successfully Requested Lab Result for DRC Application No:('.($drcApplication->application_no??'') .').';

                $drcApplication->drcComments()->create([
                    'comment_type' => 'officer_to_lab',
                    'from_officer_id' => auth()->user()->id,
                    'to_officer_id' => NULL,
                    'title' => "Lab Result Request",
                    'comment' => $msg . ($request->remark? ('<br/>' . $request->remark): '' )
                ]);

            } else {
                $msg = 'Successfully Saved Lab Result Request for DRC Application No:('.($drcApplication->application_no??'') .').';                
            }            
            return $msg;
        });

        if ( !is_null($isProcessedMsg) ) {
            return $this->jsonResponse('success', $isProcessedMsg, url()->previous());
        }

        return $this->jsonResponse('error', 'Error in Requesting Lab Result.', '#');
    }

    public function setLabResult(Request $request, DrcApplication $drcApplication)
    {
        $isProcessedMsg = DB::transaction(function() use (&$request, &$drcApplication) {
            $msg = NULL;
            $labStatus = $request->labAction==='make-pass'? 'passed': 'failed';
            $drcApplication->drcActionRecord->update(['lab_status' => $labStatus, 'lab_resulted_at' => now() ]);            
            return $labStatus;
        });

        if ( !is_null($isProcessedMsg) ) {
            return $this->jsonResponse('success', 'Successfully Set Lab Result for DRC<br/> Application No:('.($drcApplication->application_no??'') .').', url()->previous());
        }

        return $this->jsonResponse('error', 'Error in Setting Lab Result.', '#');
    }

}
