
<x-forms.text-input :attrs="[
    'name' => 'name', 
    'required' => 'required', 
    'value' => !is_null($dlmcDosageForm->parent_id)?? $dlmcDosageForm->name, 
    'placeholder' => '', 
    'label' => 'Name']" />

<x-forms.submit :attrs="['value' => '', 'placeholder' => '', 'label' => 'Save']" />