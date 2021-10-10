<?php

namespace App\Http\Controllers\Task\Dlmc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Task\Dlmc\{
        DlmcApplication, 
        Inspection,
        InspectionCorrection,
        CorrectionComment
    };
use DB;
use App\Model\Task\Attachment as DrugAttachment;
use App\Model\Task\Frontend\{
        User as FrontendUser,
        GlobalMessage
    };

class InspectionController extends Controller
{
    public function index()
    {
        $inspectionStatus = request('inspectionStatus', 'inspect');

        $lists = Inspection::whereHas('dlmcApplication', function($q) use (&$inspectionStatus){
                        $q->where('application_status', '<>', 'draft')
                        ->applicationNo(request('application_no'))
                        ->manufName(request('manufacturer_name'))
                        ->whereHas('dlmcActionRecord', function($q) use (&$inspectionStatus) {

                                if( in_array($inspectionStatus, ['inspect', 'submitted']) )
                                {
                                    return $q->where('assigned_officer_id', auth()->user()->id);
                                }else{
                                    return $q->whereNotNull('assigned_officer_id');
                                }
                            });
            })
            ->where('status', $inspectionStatus)
            ->orderBy(request('order_by', 'created_at'), request('direction', 'desc'))
            ->paginate(10);
        return view('enforcements.tasks.dlmc.inspection.index', compact( 'lists'));
    }

    public function editInspection(Request $request, DlmcApplication $dlmcApplication, Inspection $inspection)
    {
        return view('enforcements.tasks.dlmc.inspection.create.edit_inspect', compact('inspection', 'dlmcApplication'));
    }

    public function storeInspection(Request $request, DlmcApplication $dlmcApplication, Inspection $inspection)
    {

        DB::transaction(function () use(&$request, &$dlmcApplication, &$inspection){

            $inspectDatas = $request->except(['_token', 'submit']);
            
            $inspection->update($inspectDatas +
                [
                    'status' => $request->inspection_result_status == 'Satisfied after correction' ? 'inspect' : 'done',
                ]);

        });
        
        return back()->with('success', 'Successfully Update Inspection Result.');
    }

    public function storeCorrective(Request $request, Inspection $inspection)
    {
        DB::transaction(function () use(&$request, &$inspection){

            InspectionCorrection::create([
                'inspection_id' => $inspection->id,
                'non_compliance' => $request->non_compliance,
                'correction_action' => $request->correction_action,
                'due_date' => $request->due_date,
                'status' => 'initiated',
            ]);

        });
        return back()->with('success', 'Successfully Save Corrective Data.');
    }

    public function editCorrective(DlmcApplication $dlmcApplication, Inspection $inspection, InspectionCorrection $inspectionCorrection)
    {
        $form = view('enforcements.tasks.dlmc.inspection.create._correction_form',[
            "dlmcApplication" => $dlmcApplication,
            "inspection" => $inspection,
            "inspectionCorrection" => $inspectionCorrection,
            'isAjaxCall' => true
        ])->render();
	    return response()->json([
	      'data' => $form
	    ]);
    
    }

    public function updateCorrective(Request $request, DlmcApplication $dlmcApplication, Inspection $inspection, InspectionCorrection $inspectionCorrection)
    {
        DB::transaction(function () use(&$request, &$inspectionCorrection){
            $inspectionCorrection->update([
                'non_compliance' => $request->non_compliance,
                'correction_action' => $request->correction_action,
                'due_date' => $request->due_date,
            ]);

        });
        return response()->json([
            'status' => 'success',
            'redirectUrl' => route('tasks.dlmc.inspection.edit', [ 'dlmcApplication' => $dlmcApplication, 'inspection' => $inspection])
        ]);
    }

    public function deleteCorrective(Request $request, InspectionCorrection $inspectionCorrection)
    {
        $inspectionCorrection->delete();

        return back()->with('success', 'Delete Inspection Correction Data.');
    }

    public function send(Request $request,Inspection $inspection)
    {
        DB::transaction(function () use(&$request, &$inspection){

            $inspection->update([
                'status' => 'send',
            ]);

            foreach($inspection->inspectionCorrections??[] as $inspectionCorrection)
            {
                $inspectionCorrection->update([
                    'status' => 'send',
                ]);    
            }

            GlobalMessage::create([
                'department_type' => 'drug',
                'app_type' => 'dlmc',
                'app_id' => optional($inspection->dlmcApplication)->id,
                'action_type' => strtolower($inspection->dlmcApplication->application_type) . '.inspection',
                'user_id' => $inspection->dlmcApplication->user_id,
                'subject' => 'Inspection Result',
                'message' => 'The Application No ('. optional($inspection->dlmcApplication)->application_no .') has Inspection Result.',
                'redirect_url' => ''
            ]);

            // Email to User
            // $dlmcApplication->frontendUser->notify(new InspectionNotic($dlmcApplication, $request->body));
        
        });

        return back()->with('success', 'Successfully Send Inspection Result.');

    }

    public function aceptingInspection(Request $request, Inspection $inspection, InspectionCorrection $inspectionCorrection)
    {
        DB::transaction(function () use(&$request, &$inspection, &$inspectionCorrection){

            $inspectionCorrection->update(['status' => 'complete']);
            $countCorrectionStatus = $inspection->inspectionCorrections()->whereIn('status', [ 'send', 'submitted','incomplete'])->get()->count();
        
            if( $countCorrectionStatus === 0 )
            {
                $inspection->update(['status' => 'done']);
            }
        });

        return back()->with('success', 'Successfully Inspection Corrective Result is Complete.');
    }

    public function pendingInspection(Request $request, DlmcApplication $dlmcApplication, Inspection $inspection, InspectionCorrection $inspectionCorrection)
    {
        DB::transaction(function () use(&$request, &$inspection, &$inspectionCorrection){

            CorrectionComment::create([
                'inspection_correction_id' => $inspectionCorrection->id,
                'comment' => $request->remark,
            ]);

            $inspectionCorrection->update(['status' => 'incomplete']);
            
            $countCorrectionStatus = $inspection->inspectionCorrections()->where('status', 'incomplete')->get()->count();
            
            if( $countCorrectionStatus > 0 )
            {
                $inspection->update(['status' => 'incomplete']);
            }
        });

        return response()->json([
            'status' => 'success',
            'redirectUrl' => route('tasks.dlmc.inspection.edit', [ 'dlmcApplication' => $dlmcApplication, 'inspection' => $inspection])
        ]);

    }



}
