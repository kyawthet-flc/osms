@extends('layouts.app')
@section('content')
 
<div class="row mt-5">

<div class="col-md-10 offset-md-1 mb-3">
  <a href="{{ route('general_setup.periods.index') }}" class="btn btn-primary float-left">Back</a>
</div>

<div class="col-md-10 offset-md-1">
  <x-utils.card :attrs="['title' => 'Creating Period']">
    <x-forms.form-tag :attrs="['id' => 'admin-user-form', 'class' => 'admin-user-form', 'method' => 'post', 'action' => route('general_setup.periods.store') ]">

        <x-forms.select-with-key-value :attrs="[
          'name' => 'application_module_id', 
          'label' => 'Application Module', 
          'value' => $period->application_module_id, 
          'placeholder' => '', 
          'required' => 'required',
          'selected'=> $period->application_module_id,
          'list' => $applicationModules]" />

        <x-forms.select-with-value-value :attrs="[
          'name' => 'sub_app_type', 
          'label' => 'Sub App Type('.implode(',', $applicationTypes).')', 
          'value' => $period->sub_app_type, 
          'placeholder' => '', 
          'required' => 'required',
          'selected'=> $period->sub_app_type,
          'list' => $applicationTypes]" />

        <x-forms.text-input :attrs="[
          'name' => 'name',
          'required' => 'required', 
          'value' => $period->name, 
          'placeholder' => ' ', 
          'label' => 'Name']" />

        <x-forms.select-with-value-value :attrs="[
          'name' => 'period', 
          'label' => 'Period', 
          'value' => $period->period, 
          'placeholder' => '', 
          'required' => 'required',
          'selected'=> $period->period,
          'list' => $periods]" /> 

        <x-forms.select-with-value-value :attrs="[
          'name' => 'period_unit', 
          'label' => 'period_unit', 
          'value' => $period->period_unit, 
          'placeholder' => '', 
          'required' => 'required',
          'selected'=> $period->period_unit,
          'list' => $periodUnits]" /> 

        <x-forms.textarea :attrs="[
          'name' => 'remark',
          'value' => $period->remark, 
          'placeholder' => '', 
          'label' => 'Remark']" />

          <x-forms.submit :attrs="['value' => '', 'placeholder' => '', 'label' => 'Save']" />
     </x-forms.form-tag>
   </x-utils.card>
  </div>
</div>
@endsection