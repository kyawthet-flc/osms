@extends('layouts.app')
@section('content')
 
<div class="row mt-5">

<div class="col-md-10 offset-md-1 mb-3">
  <a href="{{ route('general_setup.divisions.index') }}" class="btn btn-primary float-left">Back</a>
</div>

<div class="col-md-10 offset-md-1">
  <x-utils.card :attrs="['title' => 'Creating Division']">
    <x-forms.form-tag :attrs="['id' => 'admin-user-form', 'class' => 'admin-user-form', 'method' => 'post', 'action' => route('general_setup.divisions.store') ]">
             
        <x-forms.select-with-key-value :attrs="['name' => 'country_id', 'required' => 'required', 
          'value' => $division->country_id, 
          'placeholder' => '', 
          'selected' => $division->country_id,
          'list' => $countries,
          'label' => 'Country']" />

        <x-forms.select-with-value-value :attrs="['name' => 'type', 'required' => 'required', 
            'value' => $division->type, 
            'placeholder' => '', 
            'selected' => $division->type,
            'list' => ['State', 'Division'],
            'label' => 'State or Reason']" />

        <x-forms.text-input :attrs="['name' => 'name', 'required' => 'required', 
        'value' => $division->name, 
        'placeholder' => '', 
        'label' => 'Name']" />

        <x-forms.text-input :attrs="['name' => 'name_mm', 
        'value' => $division->name_mm, 
        'placeholder' => ' ', 
        'label' => 'Name(in Myanmar)']" />
     

          <x-forms.submit :attrs="['value' => '', 'placeholder' => '', 'label' => 'Save']" />
     </x-forms.form-tag>
   </x-utils.card>
  </div>
</div>
@endsection