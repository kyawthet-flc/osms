<!-- PAGENO: OSMS-007 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Product Detail']">
   @include('clients.products.product-detail')
</x-utils.card>
@endsection