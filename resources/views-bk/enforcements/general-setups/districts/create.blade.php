@extends('layouts.app')
@section('content')
 
<div class="row mt-5">

<div class="col-md-10 offset-md-1 mb-3">
  <a href="{{ route('general_setup.districts.index') }}" class="btn btn-primary float-left">Back</a>
</div>

<div class="col-md-10 offset-md-1">
  <x-utils.card :attrs="['title' => 'Creating District']">
    <x-forms.form-tag :attrs="['id' => 'admin-user-form', 'class' => 'admin-user-form', 'method' => 'post', 'action' => route('general_setup.districts.store') ]">
             
        <x-forms.select-with-key-value :attrs="['name' => 'division_id', 'required' => 'required', 
          'value' => $district->division_id, 
          'placeholder' => '', 
          'selected' => $district->division_id,
          'list' => $divisions,
          'label' => 'Division']" />


        <x-forms.text-input :attrs="['name' => 'name', 'required' => 'required', 
        'value' => $district->name, 
        'placeholder' => '', 
        'label' => 'Name']" />

        <x-forms.text-input :attrs="['name' => 'name_mm', 
        'value' => $district->name_mm, 
        'placeholder' => ' ', 
        'label' => 'Name(in Myanmar)']" />
     

          <x-forms.submit :attrs="['value' => '', 'placeholder' => '', 'label' => 'Save']" />
     </x-forms.form-tag>
   </x-utils.card>
  </div>
</div>
@endsection