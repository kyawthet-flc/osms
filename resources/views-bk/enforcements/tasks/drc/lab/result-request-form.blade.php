<x-forms.form-tag :attrs="['id' => 'lab-result-request-form', 'class' => 'lab-result-request-form', 'method' => 'GET', 'action' => route('tasks.drc.lab_send_result_request_form',['drcApplication' => $drcApplication]) ]">
<div class="row">  
      <div class="col-md-12">
           <x-forms.text-input :attrs="['name' => 'application_no', 'required' => 'required', 'readOnly' => 'readOnly', 'label' => 'Application No.', 'value' => request('application_no', $drcApplication->application_no), 'placeholder' => 'Application No.']" />
      </div>
      <div class="col-md-12"> 
           <x-forms.text-input :attrs="['name' => 'application_date',  'required' => 'required', 'label' => 'Application Date', 'readOnly' => 'readOnly', 'value' => request('application_date', $drcApplication->drcActionRecord->submitted_at->format('Y-m-d') ), 'placeholder' => 'Application Date']" />
      </div>
      <div class="col-md-12"> 
           <x-forms.text-input :attrs="[
               'name' => 'sample_receipt_no', 
               'required' => 'required', 
               'label' => 'Sample Receipt No.', 
               'readOnly' => 'readOnly', 
               'value' => request('sample_receipt_no',  $drcApplication->drcSampleInformations->sample_receipt_no), 
               'placeholder' => 'Application Date']" 
          />
      </div>
      <div class="col-md-12"> 
           <x-forms.text-input :attrs="[
               'name' => 'sample_qty', 
               'required' => 'required', 
               'label' => 'Sample Quantity', 
               'value' => request('sample_qty', optional($drcApplication->labResult)->sample_qty?? $drcApplication->DrcSampleInformation->sample_quantities), 
               'placeholder' => 'Sample Quantity']" 
          />
      </div>
      {{--
          <div class="col-md-12"> 
           <x-forms.textarea :attrs="['name' => 'remark', 'label' => 'Remark', 'value' => request('remark'), 'placeholder' => 'Remark...']" />
      </div>
     --}}
   
      <input type="hidden" name="actionType" value="" />
      <div class="col-md-12 mt-4 mb-3 text-right">
          <button type="button" class="btn btn-warning send-lab-result-request-btn" form-id="lab-result-request-form" value="save-lab-result-request">Save Lab Result Request</button>
          <button type="button" class="btn btn-success send-lab-result-request-btn" form-id="lab-result-request-form" value="send-lab-result-request">Send Lab Result Request</button>
          <button type="button" class="btn btn-danger no-laert" data-dismiss="modal">Close</button>
       </div>
  </div>
</x-forms.form-tag>