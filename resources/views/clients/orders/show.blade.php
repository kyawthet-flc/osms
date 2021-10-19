<!-- PAGENO: OSMS-019 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Tracking Code:    ' . $order->code]">
    @include('clients.orders._order_detail')
</x-utils.card >  
@endsection