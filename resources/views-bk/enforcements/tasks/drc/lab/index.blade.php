@extends('layouts.app')

@section('title') {{$title?? 'DRC Lab'}} @endsection

@section('content')
    <x-utils.card :attrs="['title' =>  'DRC Lab']">
       @include('enforcements.tasks.drc.lab.list._nav')
	   @include('enforcements.tasks.drc.lab.list._search')
	   @include('enforcements.tasks.drc.lab.list._index')
	</x-utils.card>
@endsection
