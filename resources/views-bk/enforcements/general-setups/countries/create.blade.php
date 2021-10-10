@extends('layouts.app')
@section('content')
 
<div class="row mt-5">

<div class="col-md-10 offset-md-1 mb-3">
  <a href="{{ route('general_setup.countries.index') }}" class="btn btn-primary float-left">Back</a>
</div>

<div class="col-md-10 offset-md-1">
  <x-utils.card :attrs="['title' => 'Creating Country']">
    <x-forms.form-tag :attrs="['id' => 'admin-user-form', 'class' => 'admin-user-form', 'method' => 'post', 'action' => route('general_setup.countries.store') ]">
        <x-forms.text-input :attrs="['name' => 'name', 'required' => 'required', 
        'value' => $country->name, 
        'placeholder' => '', 
        'label' => 'Name']" />

        <x-forms.text-input :attrs="['name' => 'name_mm', 
        'value' => $country->name_mm, 
        'placeholder' => ' ', 
        'label' => 'Name(in Myanmar)']" />
    
        <x-forms.text-input :attrs="['name' => 'code', 'required' => 'required', 
        'value' => $country->code, 
        'placeholder' => '', 
        'label' => 'Code']" />

          <x-forms.submit :attrs="['value' => '', 'placeholder' => '', 'label' => 'Save']" />
     </x-forms.form-tag>
   </x-utils.card>
  </div>
</div>
@endsection