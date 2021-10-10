@extends('layouts.app')
@section('title') {{$title?? 'DRC Lab'}} @endsection
@section('content')

{{--
    @if( 'lab-bioessay-form' === $selectedLabResultForm )
      @include('lab-sections.drc.forms.lab-bioessay-form._form')
    @endif
    @if( 'lab-contamination-form' === $selectedLabResultForm )
      @include('lab-sections.drc.forms.lab-contamination-form._form')
    @endif
    @if( 'lab-disinfectant-form' === $selectedLabResultForm )
      @include('lab-sections.drc.forms.lab-disinfectant-form._form')
    @endif
    @if( 'lab-pharmaceutical-form' === $selectedLabResultForm )
      @include('lab-sections.drc.forms.lab-pharmaceutical-form._form')
    @endif
    @if( 'lab-sterility-form' === $selectedLabResultForm )
      @include('lab-sections.drc.forms.lab-sterility-form._form')
    @endif
--}}

<x-utils.card :attrs="['title' =>  'DRC Lab Detail']">
    @if( in_array($drcApplication->drcActionRecord->lab_status,['received', 'passed', 'failed']))
    
    @include('enforcements.tasks.drc.lab.detail._main')
    @include('enforcements.tasks.drc.lab.detail._lab-bioessay-form',['labTitle' => 'Bioessay Form'])
    @include('enforcements.tasks.drc.lab.detail._lab-contamination-form',['labTitle' => 'Contamination Form'])
    {{-- @include('enforcements.tasks.drc.lab.detail._lab-disinfectant-form',['labTitle' => 'Disinfectant Form'])-- }}

    @else
        <h4 class="text-danger text-center pt-5 pb-5">
            Currently Cannot View Lab Detail
        </h4>
    @endif
</x-utils.card>

@endsection