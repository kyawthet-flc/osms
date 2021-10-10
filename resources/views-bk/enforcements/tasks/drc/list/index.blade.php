@extends('layouts.app')

@section('title') {{$title}} @endsection

@section('content')

	<?php
		$drcTasksByAppStatus = auth()->user()->drcTasksByAppStatus();
		$drcCommonCountArr = auth()->user()->drcCommonCountArr(request('applicationType'));
		$totalDrcCount = auth()->user()->totalDrcCount(request('applicationType'));
	?>

    <x-utils.card :attrs="['title' => $cardTitle? ($cardTitle . '(Total Application:'.caseCounter($totalDrcCount).')' ) : '']">
       @include('enforcements.tasks.drc.list._nav')
	   @include('enforcements.tasks.drc.list._search')

	   @if( auth()->user()->isDirectorGeneral() || auth()->user()->isDeputyisDirectorGeneral() )
	      @include('enforcements.tasks.drc.list._list-dg-ddg')
	   @else
	      @include('enforcements.tasks.drc.list._list')
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

            $('.request-registration-fee-btn').on('click', function(e){

                e.preventDefault();
                var self = $(this);
                var url = $(this).data('url');
                var redirectUrl = $(this).attr('redirect-url');

                Swal.fire({
                    title: "Are you sure request registration fee?",
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    showCancelButton: true,
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {

                        //ElementHelpers.disableElement(self);
                        ElementHelpers.displayOverlay('Please wait...');

                        $.ajax({
                            url: url,
                            method: 'post',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                redirectUrl: redirectUrl
                            },
                        }).then(function(response){

                            if ( 'success' === response.status ) {

                                Swal.fire({ html: response.msg, confirmButtonColor: '#3085d6', icon: 'success' }).then(function(result){
                                    if ( result.isConfirmed ) {
                                        window.location.href = response.redirectUrl
                                    }
                                });

                            } else if ( 'error' === response.status ) {
                                Swal.fire({html: response.msg, confirmButtonColor: '#3085d6', icon: 'error'});
                            }

                            ElementHelpers.enableElement( self );
                            ElementHelpers.hideOverlay();

                        }).catch(function(err, xhr, text) {

                            var validationMsgs;
                            if( err.status === 500 ) {
                                validationMsgs = 'Webmaster has trying to fix!';
                            }

                            Swal.fire({html: validationMsgs, confirmButtonColor: '#3085d6', icon: 'error'});
                            ElementHelpers.enableElement( self );
                            ElementHelpers.hideOverlay();
                        });
                    }
                });

            });
        });
    </script>
@endsection
