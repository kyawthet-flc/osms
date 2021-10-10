<!-- PAGENO: SHOP-003 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'New Shop', 'backUrl' => (request('redirectUrl')?? route('shop.index')) ]">
    <div class="row justify-content-center pt-3 pb-5">
        <div class="col-md-6">
            @include('clients.shops._form',['action' => route('shop.store'), 'method' => 'post', 'submitLabel' => 'Create', 'confirmationText' => 'Are you sure to create?' ])
        </div>
    </div>
</x-utils.card>
@endsection