@extends('layouts.app')

@section('title') {{$title}} @endsection

@section('content')

   <!-- 
       Go to section
    -->
    <div class="col-md-12 pt-3 pb-3">
        <a class="pull-right pl-3" href="{{ request()->url() }}#comment-section">Go To Comment</a>
        <a class="pull-right pl-3" href="{{ request()->url() }}#payment-information">Go To Payment Information</a>
        <a class="pull-right pl-3" href="{{ request()->url() }}#document">Go To Document Uploads</a>
        <a class="pull-right pl-3" href="{{ request()->url() }}#importer">Go To Importer</a>
        <a class="pull-right pl-3" href="{{ request()->url() }}#product-section">Go To Product Details</a>
    </div>
 
    <x-utils.card :attrs="['title' => 'Application Info', 'id' => 'Application Info' ]">
        @include('enforcements.tasks.onetime.detail.new._application-info')    
    </x-utils.card>
 
    <x-utils.card :attrs="['title' => 'Product Details', 'id' => 'product-section' ]">
        @include('enforcements.tasks.onetime.detail.new._product')    
    </x-utils.card>	

    

    <x-utils.card :attrs="['title' => 'Importer', 'id' => 'importer' ]">
        @include('enforcements.tasks.onetime.detail.new._importer')
    </x-utils.card>	

    <x-utils.card :attrs="['title' => 'Document Uploads', 'id' => 'document' ]">
        @include('enforcements.tasks.onetime.detail.new._document-upload')
    </x-utils.card>
    <x-utils.card :attrs="['title' => 'Payment Information', 'id' => 'payment-information' ]">
        @include('enforcements.tasks.onetime.detail.common-payment-info')
    </x-utils.card>

    <x-utils.card :attrs="['title' => 'Comment', 'id' => 'comment-section' ]">        
        @include('enforcements.tasks.onetime.detail.common-display-comments')
        @if( auth()->user()->id === $application->onetimeActionRecord->assigned_officer_id )
           @include('enforcements.tasks.onetime.detail.common-action-buttons')
        @endif       
       @include('enforcements.tasks.onetime.detail.common-action-boxes')
    </x-utils.card>	

    @include('enforcements.tasks.onetime.detail.common-back-button')
    
@endsection

@section('js')
  @parent
  <script> 
     OFFICER_ACTION().togglingActionBoxByBtn()
     OFFICER_ACTION().submitActionBox()
  </script>
@endsection