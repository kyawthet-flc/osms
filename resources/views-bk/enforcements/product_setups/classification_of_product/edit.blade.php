@extends('layouts.app')
@section('content')
    <div class="row mt-5">
        <div class="col-md-10 offset-md-1 mb-2">
            <a href="{{ route('product_setup.classification_product.index') }}" class="btn btn-primary float-left mb-3">Back</a>
        </div>
        <div class="col-md-10 offset-md-1">

            <x-utils.card :attrs="['title' => 'Edit New Classification Product']">
                <x-forms.form-tag :attrs="['id' => 'edit-admin-user-form', 'class' => 'edit-admin-user-form', 'method' => 'put', 'action' => route('product_setup.classification_product.update', $product->id) ]">
                    @include('enforcements.product_setups.classification_of_product._form')
                </x-forms.form-tag>
            </x-utils.card>

        </div>
    </div>
@endsection
