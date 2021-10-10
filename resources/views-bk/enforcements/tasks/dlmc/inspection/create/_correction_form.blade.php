<?php 
$buttonLabel = 'Add';
$method = 'put';
$updateClasName = '';
$updateFormId = '';
$route = route('tasks.dlmc.corrective.store', $inspection);
 
if( isset($inspectionCorrection->id) ) {
   $buttonLabel = 'Save';
   $method = 'put';
   $updateFormId = 'save-correction-form';
   $updateClasName = 'save-correction-btn';
   $route = route('tasks.dlmc.corrective.update', [ 'dlmcApplication' => $dlmcApplication, 'inspection' => $inspection, 'inspectionCorrection' => $inspectionCorrection ]);
}

?>
    <form method="{{ $method }}" action="{{ $route }}" id="{{ $updateFormId }}"> 
        @csrf
        <div class="row">
            <div class="col-md-12 text-center mb-4 mt-4">
                <h4>Create Inspection Corrective Action Attachment</h4>
            </div>
            <div class="col-md-6"> 
                <x-forms.textarea :attrs="[
                    'name' => 'non_compliance', 
                    'value' => $inspectionCorrection->non_compliance??'', 
                    'placeholder' => '', 
                    'label' => 'Non-Compliance'
                    ]"/>
            </div>
            <div class="col-md-6">
                <x-forms.textarea :attrs="[
                    'name' => 'correction_action', 
                    'value' => $inspectionCorrection->correction_action??'', 
                    'placeholder' => '', 
                    'label' => 'Correction Action Request'
                    ]"/>
            </div>
            <div class="col-md-6">
                <label for="due_date">Due Date</label>
                <input class="form-control" name="due_date" type="date" value="{{ $inspectionCorrection->due_date??'' }}" placeholder="">
            </div>
            @if ($inspection->status == 'inspect')    
                <div class="col-md-12 text-center mb-4 mt-4">
                    <button class="btn btn-primary {{ $updateClasName }}">{{ $buttonLabel }}</button>
                </div>
            @endif
        </div>
    </form>
