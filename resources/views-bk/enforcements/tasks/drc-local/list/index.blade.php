@extends('layouts.app')

@section('title') {{$title}} @endsection

@section('content')

	<?php
		$drcLocalTasksByAppStatus = auth()->user()->drcLocalTasksByAppStatus();
		$drcLocalCommonCountArr = auth()->user()->drcLocalCommonCountArr(request('applicationType'));
		$totalDrcLocalCount = auth()->user()->totalDrcLocalCount(request('applicationType'));
	?>

    <x-utils.card :attrs="['title' => $cardTitle? ($cardTitle . '(Total Application:'.caseCounter($totalDrcLocalCount).')' ) : '']">
       @include('enforcements.tasks.drc-local.list._nav')
	   @include('enforcements.tasks.drc-local.list._search')

	   @if( auth()->user()->isDirectorGeneral() || auth()->user()->isDeputyisDirectorGeneral() )
	      @include('enforcements.tasks.drc-local.list._list-dg-ddg')
	   @else
	      @include('enforcements.tasks.drc-local.list._list')
	   @endif

	</x-utils.card>
@endsection
@section('js')
    <script>
        $(function() {
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

            OFFICER_ACTION().submitActionBox();
        });
    </script>
@endsection
