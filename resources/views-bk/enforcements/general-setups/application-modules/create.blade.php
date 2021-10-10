@extends('layouts.app')
@section('content')
<div class="row mt-5">
<div class="col-md-10 offset-md-1">

<x-utils.card :attrs="['title' => 'Creating New Office User']">
    <x-forms.form-tag :attrs="['id' => 'admin-user-form', 'class' => 'admin-user-form', 'method' => 'post', 'action' => route('general_setup.applicationModules.store') ]">
        @include('enforcements.general-setups.application-modules._form')
    </x-forms.form-tag>
</x-utils.card>

</div>
</div>
@endsection