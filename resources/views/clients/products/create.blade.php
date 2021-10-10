<!-- PAGENO: OSMS-008 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'New Product', 'backUrl' => (request('redirectUrl')?? route('product.index')) ]">
    <div class="row justify-content-center pt-3 pb-5">
        <div class="col-md-8">
            @include('clients.products._form',['action' => route('product.store'), 'method' => 'post', 'submitLabel' => 'Create', 'confirmationText' => 'Are you sure to create?' ])
        </div>
    </div>  
</x-utils.card>
@endsection