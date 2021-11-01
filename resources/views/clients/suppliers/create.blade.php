<!-- PAGENO: SHOP-015 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'New Supplier', 'backUrl' => (request('redirectUrl')?? route('supplier.index')) ]">
    <div class="row justify-content-center pt-3 pb-5">
        <div class="col-md-6">
            @include('clients.suppliers._form',['action' => route('supplier.store'), 'method' => 'post', 'submitLabel' => 'Create', 'confirmationText' => 'Are you sure to create?' ])
        </div>
    </div>
</x-utils.card>
@endsection