@php
   $application->load(['dlmcComments', 'dlmcComments.fromOfficer', 'dlmcComments.toOfficer']);
@endphp

@foreach ($application->dlmcComments as $comment)

       @if( $comment->comment_type === 'user_to_officer' )
          <small class="half-opacity">From Applicant</small>
       @else
        <b>{{ optional($comment->fromOfficer)->name }}</b>
       @endif
        <!-- To -->
        @if( 'officer_to_user' === $comment->comment_type )
            <small class="half-opacity"> => To Applicant</small>
        @elseif( 'officer_to_lab' === $comment->comment_type )
            <small class="half-opacity"> => Lab Section</small>
        @else
        <b>=>  {{ optional($comment->toOfficer)->name }}</b>
        @endif

        <div style="float: right;" >
        <small>{{$comment->created_at}}</small>
    </div>
    <br> <br>
    {!!$comment->comment!!}
    <hr>
@endforeach


@section('css')
@parent
<style>
    .header-background-yellow .card-header {
        background: antiquewhite
    }

    .half-opacity {
        opacity: 50%;
    }
    .card-title {
        font-size: 19px !important;
    }
</style>
@endsection
