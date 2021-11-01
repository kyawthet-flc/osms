<!-- PAGENO: OSMS-xxx -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Sub Product Form','backUrl' => (request('redirectUrl')?? route('product.index'))]">
    <div class="row justify-content-center pt-3 pb-5">
        <div class="col-md-12">
            @include('clients.products._sub_product_form')
        </div>
    </div>
</x-utils.card>
@endsection