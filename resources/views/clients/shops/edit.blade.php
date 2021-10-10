<!-- PAGENO: OSMS-004 -->

@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Edit Shop', 'backUrl' => (request('redirectUrl')?? route('shop.index')) ]">
    <div class="row justify-content-center pt-3 pb-5">
        <div class="col-md-6">
            @include('clients.shops._form',['action' => route('shop.update', $shop), 'method' => 'put', 'submitLabel' => 'Update', 'confirmationText' => 'Are you sure to update?' ])
        </div>
    </div>
</x-utils.card>
@endsection