<div class="col-md-12 text-center">
    <h4>Manufacturer Informations</h4>
</div>
<x-forms.text-input :attrs="[
    'name' => 'factory_name', 
    'value' => $inspection->factory_name, 
    'placeholder' => '', 
    'label' => 'Factory Name'
    ]"/>
<x-forms.text-input :attrs="[
    'name' => 'factory_address', 
    'value' => $inspection->factory_address, 
    'placeholder' => '', 
    'label' => 'Factory Address'
    ]"/>
<x-forms.text-input :attrs="[
    'name' => 'certificate_no', 
    'value' => $inspection->certificate_no, 
    'placeholder' => '', 
    'label' => 'Certificate No'
    ]"/>
<x-forms.text-input :attrs="[
    'name' => 'factory_type', 
    'value' => $inspection->factory_type, 
    'placeholder' => '', 
    'label' => 'Factory Type'
    ]"/>
<x-forms.text-input :attrs="[
    'name' => 'product_scope', 
    'value' => $inspection->product_scope, 
    'placeholder' => '', 
    'label' => 'Product Scope'
    ]"/>
<x-forms.text-input :attrs="[
    'name' => 'sub_category', 
    'value' => $inspection->sub_category, 
    'placeholder' => '', 
    'label' => 'Sub Category'
    ]"/>

<div class="row">
    
    @php
        $resultStatus = [
            'Satisfied' => 'Satisfied',
            'Unsatisfied' => 'Unsatisfied',
            'Satisfied after correction' => 'Satisfied after correction',
        ];
    @endphp
    <div class="col-md-12">

        @if (!is_null($inspection->inspection_result_status))
            <x-forms.text-input :attrs="[
                'name' => 'inspection_result_status', 
                'value' => $inspection->inspection_result_status, 
                'placeholder' => '', 
                'label' => 'Inspection Result Status',
                'readOnly' => 'readonly'
                ]"/>
        @else
        <x-forms.select-with-key-value :attrs="[
            'name' => 'inspection_result_status', 
            'label' => 'Inspection Result Status', 
            'value' => '', 
            'placeholder' => '', 
            'selected'=> $inspection->inspection_result_status,
            'list' => $resultStatus]" />
        @endif
    </div>
</div>

<x-forms.submit :attrs="['name' => 'submit', 'value' => '', 'placeholder' => '', 'label' => 'Save']" />

