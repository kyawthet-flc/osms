<!-- PAGENO: OSMS-009 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Edit Product','backUrl' => (request('redirectUrl')?? route('product.index'))]">
    <div class="row pt-3 pb-5">
        <div class="col-md-6" style="padding: 12px 5px 0;">
            @include('clients.products._form',['action' => route('product.update', $product), 'method' => 'put', 'submitLabel' => 'Update', 'confirmationText' => 'Are you sure to update?' ])
        </div>
        <div class="col-md-6">
            <a href="{{ route('product.sub_product.list', ['sku' => $product->sku]) }}">
                <i class="mdi mdi-format-list-numbers"></i>Product Variation
            </a>            
            @include('clients.products.product-supplyments.info')
        </div>
    </div>
</x-utils.card>
@endsection