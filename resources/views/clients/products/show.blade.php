<!-- PAGENO: OSMS-007 -->
@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Product Detail']">
   @include('clients.products._product_detail')
</x-utils.card>
@endsection