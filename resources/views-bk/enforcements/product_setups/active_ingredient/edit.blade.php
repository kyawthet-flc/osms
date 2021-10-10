@extends('layouts.app')
@section('content')
    <div class="row mt-5">
        <div class="col-md-10 offset-md-1">

            <x-utils.card :attrs="['title' => 'Edit active_ingredient']">
                <x-forms.form-tag :attrs="['id' => 'edit-admin-user-form', 'class' => 'edit-admin-user-form', 'method' => 'put', 'action' => route('product_setup.ingredient.update', $product->id) ]">
                    @include('enforcements.product_setups.active_ingredient._form')
                </x-forms.form-tag>
            </x-utils.card>

        </div>
    </div>
@endsection
