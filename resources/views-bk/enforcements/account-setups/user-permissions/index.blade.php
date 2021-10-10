@extends('layouts.app')
@section('content')

<div class="row">
      <div class="col-md-12">
      <a href="{{ route('account_setup.adminUsers.index') }}" class="btn btn-primary float-left mb-3">Back</a>
      </div>
   </div>
   
<x-utils.card :attrs="['title' => 'Permissions For ' . $adminUser->name ]">
   
   <div class="row">
      <x-forms.form-tag :attrs="['id' => 'permission-form', 'class' => 'permission-form', 'method' => 'post', 'action' => route('account_setup.adminUsers.permissions.store', $adminUser) ]">
      @foreach($permissions as $appModule => $permissionArr)
        <div class="col-md-4">
            <h4 class="mb-2">{{ strtoupper($appModule) }}</h4>
            <label class="col-md-12"><input type="checkbox" value="{{ $appModule }}" class="select-all" /><b> All</b></label>
            @foreach($permissionArr as $k => $permission)
            <label class="col-md-12" for="{{ $permission->id }}">
            <input 
            type="checkbox" class="child-item-{{ $appModule }} child-item"
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

@section('js')
  @parent
  <script>
    $(function(){

            $.each($('.select-all'), function(k, parentObj){
               MultiCheckboxSelection($('.child-item-' + $(parentObj).val()), $(parentObj), true);
            });

            $('.select-all').click(function(e){
               MultiCheckboxSelection($('.child-item-' + $(this).val()), $(this));
            });
    });
  </script>
@endsection