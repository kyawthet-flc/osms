<x-utils.card :attrs="['title' =>  'Lab Result']">
<div class="row">
    <label class="col-md-3">Lab Status</label>
    <label class="col-md-9">{{ ucwords(optional($labResult)->labsection_status) }}</label>

    <label class="col-md-3">Lab Application No.</label>
    <label class="col-md-9">{{ optional($labResult)->lab_application_no}}</label>
 
    <label class="col-md-3">Sample Recipt No.</label>
    <label class="col-md-9">{{ optional($labResult)->sample_receipt_no }}</label>

    <label class="col-md-3">Received Date</label>
    <label class="col-md-9">{{ optional($labResult)->received_at }}</label>

    <label class="col-md-3">Remark</label>
    <label class="col-md-9">{{ optional($labResult)->remark }}</label>

</div>
</x-utils.card>