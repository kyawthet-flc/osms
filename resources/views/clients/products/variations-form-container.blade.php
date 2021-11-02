<!-- PAGENO: OSMS-xxx -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Variation Form','backUrl' => (request('redirectUrl')?? route('product.index'))]">
    <div class="row justify-content-center pt-3 pb-5">
        <div class="col-md-12">
            @include('clients.products.variation-form')
        </div>
    </div>
</x-utils.card>
@endsection