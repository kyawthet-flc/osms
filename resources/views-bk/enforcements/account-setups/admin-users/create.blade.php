@extends('layouts.app')
@section('content')
<div class="row mt-5">
<div class="col-md-10 offset-md-1">

<div class="row">
    <div class="col-md-12">
    <a href="{{ route('account_setup.adminUsers.index') }}" class="btn btn-primary float-left mb-3">Back</a>
    </div>
</div>

<x-utils.card :attrs="['title' => 'Creating New Office User']">
    <x-forms.form-tag :attrs="['id' => 'admin-user-form', 'class' => 'admin-user-form', 'method' => 'post', 'action' => route('account_setup.adminUsers.store') ]">
        @include('enforcements.account-setups.admin-users._form')
    </x-forms.form-tag>
</x-utils.card>

</div>
</div>
@endsection