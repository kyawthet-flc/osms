<!-- PAGENO: OSMS-016 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Edit Customer', 'backUrl' => (request('redirectUrl')?? route('customer.index')) ]">
    <div class="row justify-content-center pt-3 pb-5">
        <div class="col-md-6">
            @include('clients.customers._form',['action' => route('customer.update', $customer), 'method' => 'put', 'submitLabel' => 'Update', 'confirmationText' => 'Are you sure to update?' ])
        </div>
    </div>
</x-utils.card>
@endsection