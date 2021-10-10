@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Permissions For ' . $adminUser->name]">

   <!-- <a href="{{ route('account_setup.adminUsers.create') }}" class="btn btn-primary float-left mb-3">Add Office User</a> -->

   <div class="row">
      <x-forms.form-tag :attrs="['id' => 'permission-form', 'class' => 'permission-form', 'method' => 'post', 'action' => route('account_setup.adminUsers.permissions.store', $adminUser) ]">
      @foreach($permissions as $appModule => $permissionArr)
        <div class="col-md-4">
            <h4 class="mb-2">{{ strtoupper($appModule) }}</h4>
            @foreach($permissionArr as $k => $permission)
            <label class="col-md-12" for="{{ $permission->id }}">
            <input 
            type="checkbox" 
            @if(in_array($permission->id,$givenPermissions)) checked="checked" @endif
            id="{{ $permission->id }}" 
            value="{{ $permission->id }}" 
            name="permissions[{{ strtolower($appModule) }}][{{$permission->id}}]" /> {{ $permission->name }}
            </label>
            @endforeach
        </div>
      @endforeach
      <div class="col-md-12 mt-5">
      <x-forms.submit :attrs="['name' => 'submit', 'value' => '', 'placeholder' => '', 'label' => 'Save']" />
       </div>
      </x-forms.form-tag>
   </div>

</x-utils.card>
@endsection