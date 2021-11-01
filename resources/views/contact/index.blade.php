@extends('layouts.app')
@section('title') Contact @stop
@section('content')
<div class="row mt-5 justify-content-center">
   <div class="col-md-6">
       @include('contact._form')
    </div>
</div>
@endsection