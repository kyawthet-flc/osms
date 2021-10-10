@extends('layouts.app')
@section('content')
 
<div class="row mt-5">

<div class="col-md-10 offset-md-1 mb-3">
  <a href="{{ route('general_setup.dlmcDosageForms.index') }}" class="btn btn-primary float-left">Back</a>
</div>

<div class="col-md-10 offset-md-1">
  <x-utils.card :attrs="['title' => 'Creating Child Dlmc Dosage Form']">
    <x-forms.form-tag :attrs="['id' => 'admin-user-form', 'class' => 'admin-user-form', 'method' => 'post', 'action' => route('general_setup.childDlmcDosageForms.store', $dlmcDosageForm) ]">
    @include('enforcements.general-setups.dlmc_dosage_form.child._form')
     </x-forms.form-tag>
   </x-utils.card>
  </div>
</div>
@endsection