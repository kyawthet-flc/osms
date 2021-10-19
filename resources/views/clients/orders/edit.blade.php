<!-- PAGENO: OSMS-021 -->

@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Edit Order', 'backUrl' => (request('redirectUrl')?? route('order.index')) ]">
    <div class="row justify-content-center pt-3 pb-5">
        <div class="col-md-6">
            @include('clients.orders._form',['action' => route('order.update', $order), 'method' => 'put', 'submitLabel' => 'Update', 'confirmationText' => 'Are you sure to update?' ])
        </div>
    </div>
</x-utils.card>
@endsection