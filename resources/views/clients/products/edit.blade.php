<!-- PAGENO: OSMS-009 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Edit Product','backUrl' => (request('redirectUrl')?? route('product.index'))]">
    <div class="row justify-content-center pt-3 pb-5">
        <div class="col-md-6">
            @include('clients.products._form',['action' => route('product.update', $product), 'method' => 'put', 'submitLabel' => 'Update', 'confirmationText' => 'Are you sure to update?' ])
        </div>
    </div>
</x-utils.card>
@endsection