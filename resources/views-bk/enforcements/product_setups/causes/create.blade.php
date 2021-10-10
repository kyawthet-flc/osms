@extends('layouts.app')
@section('content')
    <div class="row mt-5">
        <div class="col-md-10 offset-md-1">

            <x-utils.card :attrs="['title' => 'Creating New Substance']">
                <x-forms.form-tag :attrs="['id' => 'admin-user-form', 'class' => 'admin-user-form', 'method' => 'post', 'action' => route('product_setup.cause.store') ]">
                    @include('enforcements.product_setups.causes._form')
                </x-forms.form-tag>
            </x-utils.card>

        </div>
    </div>
@endsection
