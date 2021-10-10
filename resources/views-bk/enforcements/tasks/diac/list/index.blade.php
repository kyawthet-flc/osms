@extends('layouts.app')

@section('title') {{$title}} @endsection

@section('content')

	<?php
		$diacTasksByAppStatus = auth()->user()->diacTasksByAppStatus(request('applicationType'), request('hasExtension', 'no'));
		$diacCommonCountArr = auth()->user()->diacCommonCountArr(request('applicationType'), request('hasExtension', 'no'));
		$totalDiacCount = auth()->user()->totalDiacCount(request('applicationType'), request('hasExtension', 'no'));
	?>

    <x-utils.card :attrs="['title' => $cardTitle? ($cardTitle . '(Total Application:'.caseCounter($totalDiacCount).')' ) : '']">

       @include('enforcements.tasks.diac.list._nav')
	   @include('enforcements.tasks.diac.list._search')

	   @if( auth()->user()->isDirectorGeneral() || auth()->user()->isDeputyisDirectorGeneral() )
	      @include('enforcements.tasks.diac.list._list-dg-ddg')
	   @else
	      @include('enforcements.tasks.diac.list._list')
	   @endif
	</x-utils.card>
@endsection


@section('js')
    @parent
	<script>

	  $(function(){

		// Diplay Modal Box for Reject or Approve on the list.
		$('.director-decision-on-list-btn').on('click', function(e){
			e.preventDefault();
			var directorDecisionWrapper = $('.director-decision-wrapper');
			directorDecisionWrapper.find('form#director-decision-form').attr('action', $(this).attr('href'));
			directorDecisionWrapper.find('input[name="redirectUrl"]').val(  $(this).attr('redirect-url') );
			directorDecisionWrapper.find('.subject').val( $(this).attr('subject') );
			directorDecisionWrapper.find('.summernote-lib').summernote('code',  $(this).attr('body'));
			directorDecisionWrapper.find('input[type="submit"]').addClass($(this).attr('active-btn-class')).removeClass($(this).attr('inactive-btn-class'));
			directorDecisionWrapper.modal("show");
		});

		// Reject or Approve on the list
		OFFICER_ACTION().submitActionBox()

	  })
	</script>
@endsection
