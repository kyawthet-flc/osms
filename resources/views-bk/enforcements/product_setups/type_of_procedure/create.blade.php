@extends('layouts.app')
@section('content')
    <div class="row mt-5">
        <div class="col-md-10 offset-md-1">
            <a href="{{ route('product_setup.type_of_procedure.index') }}" class="btn btn-primary float-left mb-3">Back</a>

        </div>
        <div class="col-md-10 offset-md-1">
            <x-utils.card :attrs="['title' => 'Creating New Type Of Procedure']">
                <x-forms.form-tag :attrs="['id' => 'admin-user-form', 'class' => 'admin-user-form', 'method' => 'post', 'action' => route('product_setup.type_of_procedure.store') ]">
                    @include('enforcements.product_setups.type_of_procedure._form')
                </x-forms.form-tag>
            </x-utils.card>

        </div>
    </div>
@endsection
