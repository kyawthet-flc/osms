@extends('layouts.app')
@section('content')
    <div class="row mt-5">
        <div class="col-md-10 offset-md-1 mb-3">
            <a href="{{ route('product_setup.type_of_procedure_category.index') }}" class="btn btn-primary float-left">Back</a>
        </div>
        <div class="col-md-10 offset-md-1">

            <x-utils.card :attrs="['title' => 'Edit Type Of Procedure Category']">
                <x-forms.form-tag :attrs="['id' => 'edit-admin-user-form', 'class' => 'edit-admin-user-form', 'method' => 'put', 'action' => route('product_setup.type_of_procedure_category.update', $product->id) ]">
                    @include('enforcements.product_setups.type_of_procedure_category._form')
                </x-forms.form-tag>
            </x-utils.card>

        </div>
    </div>
@endsection
