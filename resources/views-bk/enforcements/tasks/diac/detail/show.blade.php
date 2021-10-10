@extends('layouts.app')

@section('title') {{$title}} @endsection

@section('content')
   <!-- 
       Go to section
    -->
    <div class="col-md-12 pt-3 pb-3">
        <a class="pull-right pl-3" href="{{ request()->url() }}#comment-section">Go To Comment</a>
        <a class="pull-right pl-3" href="{{ request()->url() }}#premise-and-equiqments-section">Go To Premise and Equiqments</a>
        <a class="pull-right pl-3" href="{{ request()->url() }}#drug-imported-section">Go To Drug Imported</a>
        <a class="pull-right pl-3" href="{{ request()->url() }}#supervising-person-section">Go To Supervising Person</a>
        <!-- <a class="pull-right pl-3" href="{{ request()->url() }}#attachment-section">Go To Attchment</a> -->
    </div>
 
    <x-utils.card :attrs="['title' => 'Application Info', 'id' => 'Application Info' ]">
        @include('enforcements.tasks.diac.detail.new._application-info')    
    </x-utils.card>
 
    <x-utils.card :attrs="['title' => 'Applicant', 'id' => 'applicant-section' ]">
        @include('enforcements.tasks.diac.detail.new._applicant')    
    </x-utils.card>	

    <x-utils.card :attrs="['title' => 'Supervising People', 'id' => 'supervising-person-section' ]">
        @include('enforcements.tasks.diac.detail.new._supervising-person')
    </x-utils.card>	

    <x-utils.card :attrs="['title' => 'Drugs To Be Imported', 'id' => 'drugs-to-be-imported-section' ]">
        @include('enforcements.tasks.diac.detail.new._drug-imported')
    </x-utils.card>	
     
    <x-utils.card :attrs="['title' => 'Premise and Equiqments', 'id' => 'premise-and-equiqments-section' ]">
        @include('enforcements.tasks.diac.detail.new._premise-and-equiqments')
    </x-utils.card>

    @if( $application->application_type === 'amend')
        <x-utils.card :attrs="['title' => 'Amended Information', 'id' => 'amended-information' ]">
            @include('enforcements.tasks.diac.detail.amend._info')
        </x-utils.card>
    @endif

    <x-utils.card :attrs="['title' => 'Payment Information', 'id' => 'payment-information' ]">
        @include('enforcements.tasks.diac.detail.common-payment-info')
    </x-utils.card>
     
    <x-utils.card :attrs="['title' => 'Comment', 'id' => 'comment-section' ]">        
        @include('enforcements.tasks.diac.detail.common-display-comments')
        @if( auth()->user()->id === $application->diacActionRecord->assigned_officer_id )
           @include('enforcements.tasks.diac.detail.common-action-buttons')
        @endif       
       @include('enforcements.tasks.diac.detail.common-action-boxes')
    </x-utils.card>	

    @include('enforcements.tasks.diac.detail.common-back-button')
    
@endsection

@section('js')
  @parent
  <script> 
     OFFICER_ACTION().togglingActionBoxByBtn()
     OFFICER_ACTION().submitActionBox()
  </script>
@endsection