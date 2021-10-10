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
        <a class="pull-right pl-3" href="{{ request()->url() }}#lab-information">Go To Lab Section</a>
        <!-- <a class="pull-right pl-3" href="{{ request()->url() }}#ingredient-info-section">Go To Ingredient Information</a> -->

    </div>

    <x-utils.card :attrs="['title' => 'Application Info', 'id' => 'Application Info' ]">
        @include('enforcements.tasks.drc.detail.new._application-info')
    </x-utils.card>

    <x-utils.card :attrs="['title' => 'Product Information', 'id' => 'applicant-section' ]">
        @include('enforcements.tasks.drc.detail.new._product')
    </x-utils.card>

    <x-utils.card :attrs="['title' => 'Ingredients Information', 'id' => 'ingredient-info-section' ]">
        @include('enforcements.tasks.drc.detail.new._ingredients')
    </x-utils.card>

    <x-utils.card :attrs="['title' => 'Company Information', 'id' => 'company-info-section' ]">
        @include('enforcements.tasks.drc.detail.new._company')
    </x-utils.card>

    <x-utils.card :attrs="['title' => 'Sample Information', 'id' => 'sample-info-section' ]">
        @include('enforcements.tasks.drc.detail.new._sample')
    </x-utils.card>

   <x-utils.card :attrs="['title' => 'Upload Documents', 'id' => 'attachment-section' ]">
       @include('enforcements.tasks.drc.detail.new._upload_document')
   </x-utils.card>

   <x-utils.card :attrs="['title' => 'Registration Fee', 'id' => 'registration-fee']">
        @include('enforcements.tasks.drc.detail.common-registration-fee')
   </x-utils.card>

   <x-utils.card :attrs="['title' => 'Lab Information', 'id' => 'lab-information' ]">
       @include('enforcements.tasks.drc.detail.common-lab-section')
   </x-utils.card>

   <x-utils.card :attrs="['title' => 'Payment Information', 'id' => 'payment-information' ]">
       @include('enforcements.tasks.drc.detail.common-payment-info')
   </x-utils.card>

    <x-utils.card :attrs="['title' => 'Comment', 'id' => 'comment-section' ]">

        @include('enforcements.tasks.drc.detail.common-display-comments')

        @if( auth()->user()->id === $application->drcActionRecord->assigned_officer_id )
           @include('enforcements.tasks.drc.detail.common-action-buttons')
        @endif

       @include('enforcements.tasks.drc.detail.common-action-boxes')
    </x-utils.card>

    @include('enforcements.tasks.diac.detail.common-back-button')

    <!-- Lab Result Request Form Container in Detail VIew -->
    <x-utils.bootstrap-model-wrapper>
        <div class="row" style="padding: 3px 10px;">
            <div class="col-md-12"><h4 class="header-title pb-3 pt-3"></h4></div>
            <div class="col-md-12 lab-result-request-form-wrapper"></div>
        </div>
    </x-utils.bootstrap-model-wrapper>

@endsection

@section('js')
    @parent
    <script>
        OFFICER_ACTION().togglingActionBoxByBtn()
        OFFICER_ACTION().submitActionBox()
    </script>
@endsection
