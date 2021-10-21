@extends('layouts.app')
@section('title') Profile @stop
@section('content')
<div class="row mt-5 justify-content-center">
   <div class="col-md-6">
       <!-- 
            "id" => 1
    "name" => "Super Admin"
    "display_name" => null
    "email" => "kyawthet@gmail.com"
    "login_id" => "admin"
    "phone" => null
    "password" => "$2y$10$1VJSj8VodunWS72yN7yt9eBq6dv8mYIOiEBbb5pR7U8xYsDCXTxa6"
    "login_by" => null
    "ip" => null
    "login_status" => "logged_in"
    "status" => "active"
    "log_counter" => 23
    "remember_token" => null
    "email_verified_at" => null
    "created_at" => null
    "updated_at" => "2021-10-21 22:01:27"
        -->
        <x-utils.card :attrs="['title' => 'Profile']">
            <x-forms.form-tag :attrs="['id' => 'update-profile', 'class' => 'update-profile', 'method' => 'post', 'action' => route('update_profile') ]">
                <x-forms.text-input :attrs="['name' => 'login_id', 'value' => $user->login_id, 'label' => 'Login ID', 'readOnly' => true ]" />
                <x-forms.text-input :attrs="['name' => 'name', 'value' => $user->name, 'label' => 'Name', 'readOnly' => true]" />
                <x-forms.text-input :attrs="['name' => 'display_name', 'value' => $user->display_name, 'label' => 'Display Name']" />
                
                <dl>
                    <dt>Login Info</dt>
                    <dd>Last Logged In At: {{ $user->updated_at }}</dd>
                </dl>
                <x-forms.submit :attrs="['name' => 'submit', 'value' => '', 'placeholder' => '', 'label' => 'Save']" />
            </x-forms.form-tag>
        </x-utils.card>
    
    </div>
</div>
@endsection