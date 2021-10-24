<!-- PAGENO: SHOP-020 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'New Order', 'backUrl' => (request('redirectUrl')?? route('order.index')) ]">
    <div class="row justify-content-center pt-3 pb-5">
        <div class="col-md-12">
            @include('clients.orders._form',['action' => route('order.store'), 'method' => 'post', 'submitLabel' => 'Save', 'confirmationText' => 'Are you sure to save?' ])
        </div>
    </div>
</x-utils.card>
@endsection