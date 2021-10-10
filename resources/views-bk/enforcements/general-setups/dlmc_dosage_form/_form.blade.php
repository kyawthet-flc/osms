
@php
    $types = [
        'GMP' => 'GMP',
        'SME' => 'SME',
    ]
@endphp
<x-forms.text-input :attrs="[
    'name' => 'name', 
    'required' => 'required', 
    'value' => $dlmcDosageForm->name, 
    'placeholder' => '', 
    'label' => 'Name']" />

<x-forms.select-with-key-value :attrs="[
    'name' => 'type', 
    'required' => 'required', 
    'value' => $dlmcDosageForm->type??'', 
    'placeholder' => '', 
    'selected' => $dlmcDosageForm->type,
    'list' => $types,
    'label' => 'Dosage Form Type']" />

<x-forms.submit :attrs="['value' => '', 'placeholder' => '', 'label' => 'Save']" />