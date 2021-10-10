@extends('layouts.app')

@section('title') {{$title}} @endsection

@section('content')

    <!-- 
       Go to section
    -->
    <div class="col-md-12 pt-3 pb-3">
        <a class="pull-right pl-3" href="{{ request()->url() }}#comment-section">Go To Comment</a>
        <a class="pull-right pl-3" href="{{ request()->url() }}#document-uploads">Go To Documents</a>
        <a class="pull-right pl-3" href="{{ request()->url() }}#drugs-to-be-produced">Go To Drug Produced</a>
        <a class="pull-right pl-3" href="{{ request()->url() }}#hr-list">Go To HR List</a>
        <a class="pull-right pl-3" href="{{ request()->url() }}#supervising-person">Go To Supervising Person</a>
        <!-- <a class="pull-right pl-3" href="{{ request()->url() }}#attachment-section">Go To Attchment</a> -->
    </div>

    <x-utils.card :attrs="['title' => 'Application Info', 'id' => 'application-info' ]">
        @include('enforcements.tasks.dlmc.detail.new.0')    
    </x-utils.card>

    <x-utils.card :attrs="['title' => 'Factory Info', 'id' => 'factory-info' ]">
        @include('enforcements.tasks.dlmc.detail.new.1')    
    </x-utils.card>
 
    <x-utils.card :attrs="['title' => 'Supervising Person', 'id' => 'supervising-person' ]">
        @include('enforcements.tasks.dlmc.detail.new.2')    
    </x-utils.card>	

    <x-utils.card :attrs="['title' => 'HR List', 'id' => 'hr-list' ]">
        @include('enforcements.tasks.dlmc.detail.new.3')
    </x-utils.card>	

    <x-utils.card :attrs="['title' => 'Drugs To be Produced', 'id' => 'drugs-to-be-produced' ]">
        @include('enforcements.tasks.dlmc.detail.new.4')
    </x-utils.card>	
 
    <x-utils.card :attrs="['title' => 'Document Uploads', 'id' => 'document-uploads' ]">
        @include('enforcements.tasks.dlmc.detail.new.5')
    </x-utils.card>	

    <x-utils.card :attrs="['title' => 'Inspection Notice', 'id' => 'inspection-notice' ]">
        @include('enforcements.tasks.dlmc.detail.new.6')
    </x-utils.card>	

    @if (count($application->dlmcPaymentRecords))    
        <x-utils.card :attrs="['title' => 'Payment History', 'id' => 'payment-history' ]">
            @include('enforcements.tasks.dlmc.detail.new.7')
        </x-utils.card>	
    @endif

    @if ( !in_array($application->payment_status, ['paid', 'expierd']))
        <div class="alert alert-danger" role="alert">
            This Application need to Calculate Payment for Registration Fee!
        </div>
    @endif
    @php
        $countInspect = $application->inspections()->where('status', '<>', 'done')->count();
    @endphp
    @if ( isset($application->inspections) && $countInspect !== 0 )
        <div class="alert alert-danger" role="alert">
            This Application need to make inspection result!
        </div>
    @endif
       
    <x-utils.card :attrs="['title' => 'Comment', 'id' => 'comment-section' ]">

        @include('enforcements.tasks.dlmc.detail.common-display-comments')

        @if( auth()->user()->id === $application->dlmcActionRecord->assigned_officer_id )
           @include('enforcements.tasks.dlmc.detail.common-action-buttons')
        @endif

       @include('enforcements.tasks.dlmc.detail.common-action-boxes')
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