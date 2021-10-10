@extends('layouts.app')
@section('content')
    <div class="row mt-5">
        <div class="col-md-10 offset-md-1">

            <x-utils.card :attrs="['title' => 'Creating New active_ingredient']">
                <x-forms.form-tag :attrs="['id' => 'admin-user-form', 'class' => 'admin-user-form', 'method' => 'post', 'action' => route('product_setup.ingredient.store') ]">
                    @include('enforcements.product_setups.active_ingredient._form')
                </x-forms.form-tag>
            </x-utils.card>

        </div>
    </div>
@endsection
