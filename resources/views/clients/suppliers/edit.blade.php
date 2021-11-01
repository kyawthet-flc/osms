<!-- PAGENO: OSMS-016 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Edit Supplier', 'backUrl' => (request('redirectUrl')?? route('supplier.index')) ]">
    <div class="row justify-content-center pt-3 pb-5">
        <div class="col-md-6">
            @include('clients.suppliers._form',['action' => route('supplier.update', $supplier), 'method' => 'put', 'submitLabel' => 'Update', 'confirmationText' => 'Are you sure to update?' ])
        </div>
    </div>
</x-utils.card>
@endsection