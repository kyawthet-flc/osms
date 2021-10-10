<?php

namespace App\Http\Controllers\LabSection\Drc;

use App\Http\Controllers\Controller;
use App\Model\Task\Drc\{ DrcApplication, DrcActionRecord };
use Illuminate\Http\Request;
use DB;
use App\Model\LabSection\{
    LabResult,
    LabPml,
    LabPcl,
    LabBl,

    TestParameters,
    ReferenceMethod,
    ReferenceValue,
    Microbial,
    SubMicrobial,
    AdventitiousBacteria
};

class ActionController extends Controller
{
    protected $basePath = 'lab-sections.drc.';

    protected $labPml;
    protected $labPcl;
    protected $labBl;

    public function __construct()
    {
        $this->labPml = new LabPml;
        $this->labPcl = new LabPcl;
        $this->labBl = new LabBl;
    }

    public function resultForm(DrcApplication $drcApplication)
    {
        return $this->jsonResponse(
            'success', 'Successfully Loaded.', '#', ['view' => view($this->basePath . 'forms.result-form')->with('drcApplication', $drcApplication)->render()]
        );
    }

    // Lab Status "requested" means "lab request recevied" for Lab user
    // Lab Status "checked" means "lab result checked and ready to send" for Lab user
    // Lab Status "received" means "lab result sent" for Lab user
    public function processResult(Request $request, DrcApplication $drcApplication)
    {
        $request->validate([
            // 'sample_receipt_no' => 'required',
            'labsection_status' => 'required',
            'checked_at' => 'required'
        ]);
        // dd( \Schema::getColumnListing('lab_results') );

        $request->validate(['checked_at' => 'required']);

        $isProcessedMsg = DB::transaction(function() use (&$request, &$drcApplication){

            $msg = null;

            $labResult = $drcApplication->drcActionRecord->lab_checked_at? ['lab_rechecked_at' => now() ]: ['lab_checked_at' => now() ];

            if( 'send-lab-result' === $request->actionType) {

                $labResult = $labResult + ['lab_status' => 'received', 'lab_received_at' => now() ];
                $msg = 'Successfully Sent Lab Result for DRC Application No:('.($drcApplication->application_no??'') .').';
                $drcApplication->drcComments()->create([
                    'comment_type' => 'lab_to_officer',
                    'from_officer_id' => auth()->user()->id,
                    'to_officer_id' => NULL,
                    'title' => "Lab Result Received",
                    'comment' => $msg
                ]);

                $drcApplication->labResult->update(['lab_result_status' => 'sent', 'user_id' => auth()->user()->id]);
                $drcApplication->labResult->increment('sent_counter', 1);

            } elseif('save-lab-result' === $request->actionType) {
                $msg = 'Successfully Saved Lab Result for DRC<br/> Application No:('.($drcApplication->application_no??'xx') .').';
            }

            $drcApplication->drcActionRecord->update($labResult);
            return $msg;
        });

        if ( !is_null($isProcessedMsg) ) {
            return $this->jsonResponse('success', $isProcessedMsg, url()->previous());
        }

        return $this->jsonResponse('error', 'Error in Requesting Lab Result.', '#');
    }

    public function saveFillLabResult(Request $request,DrcApplication $drcApplication, LabResult $labResult)
    {
        $request->validate(['labsection_status' => 'required']);
        $labResult->update(['labsection_status' => $request->labsection_status, 'remark' => $request->remark]);
        return back()->with("success", "Successfully saved.");
    }

    public function fillLabResult(DrcApplication $drcApplication)
    {
        $labDetailResult = $drcApplication->labResult;

        if( is_null($labDetailResult) ) {
            $labDetailResult = $drcApplication->labResult()->create([
                'sample_receipt_no' =>  optional($drcApplication->drcSampleInformations)->sample_receipt_no,
                'received_at' => $drcApplication->drcActionRecord->lab_requested_at,
                'application_no' => $drcApplication->application_no,
                'sample_qty' => $drcApplication->DrcSampleInformation->sample_quantities
            ]);
            $labDetailResult->generateLabApplicationNo();
        }

        // To disable or enable save buttons for Lab Admin.
        $clickableLabActionBtn = in_array($drcApplication->drcActionRecord->lab_status,['requested']);

        // Check DRC Lab or DRC Local Lab
        $drcOrDrcLocalLab = $drcApplication->application_module_id == 2? 'drc-lab': 'drc-local-lab';

        // Auto Fill From Application
        $relative_data = $drcApplication->getARelative();
        $autoFills = array(
            'brand_name' => 'Test Brand name',
            'generic_name' => $drcApplication->generic_name,
            'manufacturer_name' => $relative_data->company_code,
            'manufacturer_address' => ($relative_data->domestic_or_foreign == 'Domestic') ? $relative_data->a_full_address: $relative_data->f_full_address,

            'batch_lot_no' => 'Test Batch No.',

            'manufactured_at' => '02-09-2021',//date('d-m-Y', strtotime($manufactured_at)),
            'expired_at' => '02-09-2022',//date('d-m-Y', strtotime($expired_at)),

            'size' => 'test size'
        );

        return view($this->basePath . 'forms.fill-lab-result', [
            'drcApplication' => $drcApplication,
            'selectedLabResultForm' => request('selectedLabResultForm', 'lab-bioessay-form'),//'lab-sterility-form',
            'labResult' => $labDetailResult,
            'autoFills' => $autoFills,
            'labPcl' => $labDetailResult->labPcl?? new LabPcl,
            'labPml' => $labDetailResult->labPml?? new LabPml,
            'labBl' => $labDetailResult->labBl?? new LabPml,
            'clickableLabActionBtn' => $clickableLabActionBtn,
            'drcOrDrcLocalLab' => $drcOrDrcLocalLab
        ]);

    }

    protected function sharedData(Request $request,DrcApplication $drcApplication, LabResult $labResult)
    {
        $relative_data = $drcApplication->getARelative();
        $autoFills = array(
            'brand_name' => 'Test Brand name',
            'generic_name' => $drcApplication->generic_name,
            'manufacturer_name' => $relative_data->company_code,
            'manufacturer_address' => ($relative_data->domestic_or_foreign == 'Domestic') ? $relative_data->a_full_address: $relative_data->f_full_address,

            'batch_lot_no' => 'Test Batch No.',
            'application_no' => $drcApplication->application_no,

            'manufactured_at' => '02-09-2021',//date('d-m-Y', strtotime($manufactured_at)),
            'expired_at' => '02-09-2022',//date('d-m-Y', strtotime($expired_at)),

            'size' => 'test size'
        );

        // To disable or enable save buttons for Lab Admin.
        $clickableLabActionBtn = in_array($drcApplication->drcActionRecord->lab_status,['requested']);
        // Check DRC Lab or DRC Local Lab
        $drcOrDrcLocalLab = 'drc-lab';

        return [
            'drcApplication' => $drcApplication,
            'selectedLabResultForm' => request('selectedLabResultForm'),//'lab-sterility-form',
            'labResult' => $drcApplication->labResult,
            'autoFills' => $autoFills,
            'clickableLabActionBtn' => $clickableLabActionBtn,
            'drcOrDrcLocalLab' => $drcOrDrcLocalLab
        ];

    }

    public function pclLabForm(Request $request,DrcApplication $drcApplication, LabResult $labResult)
    {
        $labName = 'Pharmaceutical Chemistry Laboratory';
        return view(
            $this->basePath . 'forms.pcl.form',
            $this->sharedData($request, $drcApplication, $labResult) + [
                'labType' => $drcApplication->labResult->labPcl?? new LabPcl,
                'parameters' => (new TestParameters)->cached()->where('type', $labName)->pluck('name'),
                'methods' => (new ReferenceMethod)->cached()->where('type', $labName)->pluck('name'),
                'specifications' => (new ReferenceValue)->cached()->where('type', $labName)->pluck('name')
            ]
        );
    }

    public function blLabForm(Request $request,DrcApplication $drcApplication, LabResult $labResult)
    {
        $labName = 'Biostandartization Laboratory';

        return view(
            $this->basePath . 'forms.bl.form',
            $this->sharedData($request, $drcApplication, $labResult) + [
                'labType' => $drcApplication->labResult->labBl?? new LabBl,
                'parameters' => (new TestParameters)->cached()->where('type', $labName)->pluck('name'),
                'methods' => (new ReferenceMethod)->cached()->where('type', $labName)->pluck('name'),
                'specifications' => (new ReferenceValue)->cached()->where('type',$labName)->pluck('name')
            ]
        );
    }

    public function pmlLabForm(Request $request,DrcApplication $drcApplication, LabResult $labResult)
    {
        $parameters = [];
        $mediumIncubationTemperature = [];
        $growthPresenceAbsences = [];
        $testOrganisms = [];

        if( 'bioassay-test' == request('subLabPmlTestType') ) {
            $labName = 'Bio-assay Test';
        } else if( 'sterility-test' == request('subLabPmlTestType') ){
            $labName = 'Sterility Test';
        } else if( 'adventitious-fungi-test' == request('subLabPmlTestType') ){
            $labName = 'Adventitious Bacteria and Fungi Test';
        } else {
            $labName = 'Microbial Limit Test';
        }

        if ('microbial-limit-test' == request('subLabPmlTestType') ) {
            $parameters = SubMicrobial::orderBy('microbial_id')->get();
        } else if ('adventitious-fungi-test' == request('subLabPmlTestType') ) {

            $mediumIncubationTemperature = AdventitiousBacteria::whereIndex('Medium and Incubation Temperature')->pluck('value')->toArray();
            $growthPresenceAbsences = AdventitiousBacteria::whereIndex('Growth Presence/ Absence')->pluck('value')->toArray();
            $testOrganisms = AdventitiousBacteria::whereIndex('Test Organisms')->pluck('value')->toArray();

        } else {
            $parameters = (new TestParameters)->cached()->where('type', $labName)->pluck('name');
        }

        return view(
            $this->basePath . 'forms.pml.form',
            $this->sharedData($request, $drcApplication, $labResult) + [
                'labType' => $drcApplication->labResult->labPml?? new LabPml,
                'parameters' => $parameters,
                'mediumIncubationTemperature' => $mediumIncubationTemperature,
                'growthPresenceAbsences' => $growthPresenceAbsences,
                'testOrganisms' => $testOrganisms,
                'methods' => (new ReferenceMethod)->cached()->where('type', $labName)->pluck('name'),
                'specifications' => (new ReferenceValue)->cached()->where('type',$labName)->pluck('name')
            ]
        );
    }

    public function saveLabResultFormType(Request $request,DrcApplication $drcApplication, LabResult $labResult, $labFormType)
    {

        if ( 'lab-pcl-form' === $labFormType ) {

            $request->validate($this->validationRules());
            $this->labPcl->saveChanges($labResult, $request);

        } else if ( 'lab-pcl-test-form' === $labFormType ) {

            $request->validate(['test_param' => 'required', 'result' => 'required', 'ref_method' => 'required', 'specification' => 'required', 'conclusion' => 'required']);
            $this->labPcl->saveChildrenChanges($labResult, $request, request('id'));

        } else if ( 'lab-bl-form' === $labFormType ) {

            $request->validate($this->validationRules());
            $this->labBl->saveChanges($labResult, $request);

         } else if ( 'lab-bl-test-form' === $labFormType ) {

            $request->validate(['test_param' => 'required', 'result' => 'required', 'ref_method' => 'required', 'specification' => 'required', 'conclusion' => 'required']);
            $this->labBl->saveChildrenChanges($labResult, $request, request('id'));

         } else if ( 'lab-pml-form' === $labFormType ) {

            $request->validate($this->validationRules());
            $this->labPml->saveChanges($labResult, $request);

         } else if ( 'lab-pml-first-form-test' === $labFormType ) {

            $request->validate(['test_param' => 'required', 'result' => 'required', 'ref_method' => 'required', 'specification' => 'required', 'conclusion' => 'required']);
            $this->labPml->saveBioassayTest($labResult, $request, request('id'));

         } else if ( 'lab-pml-second-form-test' === $labFormType ) {

            $request->validate([
                'test_param' => 'required', 'result' => 'required', 'ref_method' => 'required', 'specification' => 'required', 'conclusion' => 'required'
            ]);
            $this->labPml->saveSterilityTest($labResult, $request, request('id'));

         } else if ( 'lab-pml-third-form-test' === $labFormType ) {

            $request->validate([
                'test_param' => 'required', 'result' => 'required', 'ref_method' => 'required', 'specification' => 'required', 'conclusion' => 'required'
            ]);
            $this->labPml->saveMicrobialLimitTest($labResult, $request, request('id'));

         } else if ( 'lab-pml-fourth-form-test' === $labFormType ) {

            $request->validate([
                'mit' => 'required', 'test_organism' => 'required', 'exposure_time' => 'required', 'growth' => 'required'
            ]);
            $this->labPml->saveAdventitiousTest($labResult, $request,  request('id'));

         }  else {
            return redirect()->route('lab_section.drc.fill_lab_result',[
                'drcApplication' => $drcApplication,
                'selectedLabResultForm' => request('selectedLabResultForm'), request('section')?'#' .  request('section'): '' ])->with('error', 'Unknown Lab Form Type.'
            );
        }

        /* return redirect()->route('lab_section.drc.fill_lab_result',[
            'drcApplication' => $drcApplication,
            'selectedLabResultForm' => request('selectedLabResultForm'), request('section')?'#' .  request('section'): ''
        ]); */
        if ( !request('redirectUrl') ) {
            return back()->with(['success' => 'Successfully Saved.']);
        }

        return redirect( request('redirectUrl') )->with(['success' => 'Successfully Saved.']);
    }

    public function deleteLabTestItem(Request $request,DrcApplication $drcApplication, LabResult $labResult, $labFormType)
    {
        if ( 'lab-pcl-test-form' === $labFormType ) {

            $this->labPcl->deleteTest($labResult, request('id'));

        } else if ( 'lab-bl-test-form' === $labFormType ) {

            $this->labBl->deleteTest($labResult, request('id'));

        } else if ( 'lab-pml-first-form-test' === $labFormType ) {

            $this->labPml->deleteBioassayTest($labResult, request('id'));

        } elseif ( 'lab-pml-second-form-test' === $labFormType ) {

            $this->labPml->deleteSterilityTest($labResult, request('id'));

        } elseif ( 'lab-pml-third-form-test' === $labFormType ) {

            $this->labPml->deleteMicrobialLimitTest($labResult, request('id'));

        }elseif ( 'lab-pml-fourth-form-test' === $labFormType ) {

            $this->labPml->deleteAdventitiousTest($labResult, request('id'));

        } else {
            return back()->with(['error' => 'Error in Deleting.']);
        }

        if( request('redirectUrl') ) {
            return redirect( request('redirectUrl') )->with(['success' => 'Successfully Deleted.']);
        }
        return back()->with(['success' => 'Successfully Deleted.']);

    }

    public function validationRules()
    {
        return [
            "title" => "required",
            "effective_at" => "required",
            "form_no" => "required",
            "version_no" => "required",
            "sop_number" => "required",

            "sample_id" => "required",
            "sub_sample_count" => "required|numeric",
            "application_no" => "required",
            "received_at" => "required",
            "brand_name" => "required",

            "generic_name" => "required",
            "manufacturer_name" => "required",
            "manufacturer_address" => "required",

            "lab_no" => "required",
            "resulted_at" => "required",
            "analysted_at" => "required",
            "batch_lot_no" => "required",

            "manufactured_at" => "required",
            "expired_at" => "required",

            "customer_name" => "required",
            "customer_address" => "required",

            "name_of_analyst" => "required",
            // "sign_of_analyst" => $request->sign_of_analyst,

            //"name_of_lab_office" => "required",
            "lab_test_status" => "required",
            "final_remark" => "required",
            "checkby_status" => "nullable"
        ];
    }


}
