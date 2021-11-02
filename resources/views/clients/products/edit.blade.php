<!-- PAGENO: OSMS-009 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Edit Product','backUrl' => (request('redirectUrl')?? route('product.index'))]">
    <div class="row justify-content-centere pt-3 pb-5">
        <div class="col-md-12" style="padding: 12px 5px 0;">
            @include('clients.products.product-form',['action' => route('product.update', $product), 'method' => 'put',
            'submitLabel' => 'Update', 'confirmationText' => 'Are you sure to update?' ])
        </div>
        <div class="col-md-12">
            @include('clients.products.product-size-color')
            @include('clients.products.variations-list')           
            @include('clients.products.product-supplier')
        </div>
    </div>
</x-utils.card>
@endsection