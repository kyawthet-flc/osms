@extends('layouts.app')

@section('content')
<div class="row mt-5">
   <div class="col-md-10 offset-md-1">

        <x-utils.card :attrs="['title' => 'Change Password']">
            <x-forms.form-tag :attrs="[
                'id' => 'store-change-password', 
                'class' => 'store-change-password', 
                'method' => 'post', 
                'action' => route('store_change_password') ]">
    
                <x-forms.password-input :attrs="['name' => 'password', 'value' => '', 'placeholder' => '', 'label' => 'Password']" />
                <x-forms.password-input :attrs="['name' => 'password_confirmation', 'value' => '', 'placeholder' => '', 'label' => 'Confirm Password']" />            
                <x-forms.submit :attrs="['name' => 'submit', 'value' => '', 'placeholder' => '', 'label' => 'Save']" />
            </x-forms.form-tag>
        </x-utils.card>
    
    </div>
</div>
@endsection