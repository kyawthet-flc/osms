@extends('layouts.app')

@section('title') {{$title}} @endsection

@section('content')

   <!--
       Go to section
    -->
    <div class="col-md-12 pt-3 pb-3">
        <a class="pull-right pl-3" href="{{ request()->url() }}#comment-section">Go To Comment</a>
        <a class="pull-right pl-3" href="{{ request()->url() }}#attachment-section">Go To Upload Documents</a>
        <a class="pull-right pl-3" href="{{ request()->url() }}#sample-info-section">Go To Sample Information</a>
        <a class="pull-right pl-3" href="{{ request()->url() }}#company-info-section">Go To Company Information</a>
        <a class="pull-right pl-3" href="{{ request()->url() }}#ingredient-info-section">Go To Ingredient Information</a>

    </div>

    <x-utils.card :attrs="['title' => 'Application Info', 'id' => 'Application Info' ]">
        @include('enforcements.tasks.drc-local.detail.new._application-info')
    </x-utils.card>

    <x-utils.card :attrs="['title' => 'Product Information', 'id' => 'applicant-section' ]">
        @include('enforcements.tasks.drc-local.detail.new._product')
    </x-utils.card>

    <x-utils.card :attrs="['title' => 'Ingredients Information', 'id' => 'ingredient-info-section' ]">
        @include('enforcements.tasks.drc-local.detail.new._ingredients')
    </x-utils.card>

    <x-utils.card :attrs="['title' => 'Company Information', 'id' => 'company-info-section' ]">
        @include('enforcements.tasks.drc-local.detail.new._company')
    </x-utils.card>

    <x-utils.card :attrs="['title' => 'Sample Information', 'id' => 'sample-info-section' ]">
        @include('enforcements.tasks.drc-local.detail.new._sample')
    </x-utils.card>

   <x-utils.card :attrs="['title' => 'Upload Documents', 'id' => 'attachment-section' ]">
       @include('enforcements.tasks.drc-local.detail.new._upload_document')
   </x-utils.card>

   <x-utils.card :attrs="['title' => 'Payment Information', 'id' => 'payment-information' ]">
       @include('enforcements.tasks.drc-local.detail.common-payment-info')
   </x-utils.card>

    <x-utils.card :attrs="['title' => 'Comment', 'id' => 'comment-section' ]">

        @include('enforcements.tasks.drc-local.detail.common-display-comments')

        @if( auth()->user()->id === $application->drcActionRecord->assigned_officer_id )
           @include('enforcements.tasks.drc-local.detail.common-action-buttons')
        @endif

       @include('enforcements.tasks.drc-local.detail.common-action-boxes')
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
