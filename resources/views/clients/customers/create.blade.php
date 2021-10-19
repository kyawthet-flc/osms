<!-- PAGENO: SHOP-015 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'New Customer', 'backUrl' => (request('redirectUrl')?? route('customer.index')) ]">
    <div class="row justify-content-center pt-3 pb-5">
        <div class="col-md-6">
            @include('clients.customers._form',['action' => route('customer.store'), 'method' => 'post', 'submitLabel' => 'Create', 'confirmationText' => 'Are you sure to create?' ])
        </div>
    </div>
</x-utils.card>
@endsection