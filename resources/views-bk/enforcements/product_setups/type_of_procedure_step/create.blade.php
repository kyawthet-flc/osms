@extends('layouts.app')
@section('content')
    <div class="row mt-5">
        <div class="col-md-10 offset-md-1 mb-3">
            <a href="{{ route('product_setup.type_of_procedure_step.index') }}" class="btn btn-primary float-left">Back</a>
        </div>
        <div class="col-md-10 offset-md-1">

            <x-utils.card :attrs="['title' => 'Creating New Type Of Procedure Step']">
                <x-forms.form-tag :attrs="['id' => 'admin-user-form', 'class' => 'admin-user-form', 'method' => 'post', 'action' => route('product_setup.type_of_procedure_step.store') ]">
                    @include('enforcements.product_setups.type_of_procedure_step._form')
                </x-forms.form-tag>
            </x-utils.card>

        </div>
    </div>
@endsection
