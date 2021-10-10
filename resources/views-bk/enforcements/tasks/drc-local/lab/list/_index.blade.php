<?php
    $cols = ['No.', 'Application No.', 'Application Date', 'Action'];
    if( 'requested' === request('labTypeStatus') ) {
       $cols = ['No.', 'Application No.', 'Application Date', 'Requested Date', 'Action'];
    }
   
    if( 'received' === request('labTypeStatus') ) {
       $cols = ['No.', 'Application No.', 'Application Date', 'Requested Date', 'Received Date', 'Action'];        
    }
   
    if( 'result' === request('labTypeStatus') ) {
       $cols = ['No.', 'Application No.', 'Application Date', 'Requested Date', 'Received Date', 'Status', 'Action'];
    }
   
?>
<x-utils.data-table class="table" :ths="$cols">

    @php 
      $indexer = 0;
      $lists->load(['drcActionRecord']);
    @endphp
    {{--  $lists->perPage() * $lists->currentPage() - $lists->perPage(); --}}
 
    @foreach ($lists as $k => $list)
        <tr>
            <td>{{ $k + 1 + $indexer }}.</td>
            <td>{{ $list->application_no }}</td>
 
            <td>{{ $list->drcActionRecord->submitted_at->format('d-m-Y') }}</td>

            @if( 'requested' === request('labTypeStatus') )
            <td>{{ $list->drcActionRecord->lab_requested_at->format('d-m-Y') }}</td>
            @endif

            @if( 'received' === request('labTypeStatus') )
            <td>{{ $list->drcActionRecord->lab_requested_at->format('d-m-Y') }}</td>
            <td>{{ $list->drcActionRecord->lab_received_at->format('d-m-Y') }}</td>
            @endif

            @if( 'result' === request('labTypeStatus') )
            <td>{{ $list->drcActionRecord->lab_requested_at->format('d-m-Y') }}</td>
            <td>{{ $list->drcActionRecord->lab_received_at->format('d-m-Y') }}</td>
              <td>{{ $list->drcActionRecord->lab_status }}</td>
            @endif            
            
            <td>
            <a class="btn btn-warning btn-sm view-lab-btn mt-1" href="{{ route('tasks.drc_local.show',['drcApplication' => $list]) }}">View Case</a>

            @if( in_array($list->drcActionRecord->lab_status,[
                'received', 'passed', 'failed'
            ]))
            <a class="btn btn-warning btn-sm view-lab-btn mt-1" href="{{ route('tasks.drc_local.lab_show',['drcApplication' => $list]) }}">View Lab</a>
            @else
            <a class="btn btn-warning btn-sm view-lab-btn mt-1 disabled" href="#">View Lab</a>
            @endif

            <!-- Lab Status is "requested" -->
            @if( 'to_request' === request('labTypeStatus') && auth()->user()->hasPermission('drc','request-lab-result') )
              @include('enforcements.tasks.drc-local.partials.lab-request-btn',[
                'redirectUrl' => url()->current(),
                'url' => route('tasks.drc_local.lab_result_request_form',['drcApplication' => $list]),
                'title' => 'Lab Result Request for Application No: ' . ($list->application_no??'') 
              ])
            @endif

            @if( 'received' === request('labTypeStatus') )              
              @include('enforcements.tasks.drc-local.partials.lab-decision-btn',[
                'redirectUrl' => url()->current(),
                'decisiondUrl' => route('tasks.drc_local.set_lab_result', ['drcApplication' => $list])
              ])
            @endif

            </td>
        </tr>
    @endforeach

</x-utils.data-table>
{{ $lists->appends(request()->all())->links() }}

<!-- Lab Result Request Form Container -->
 <x-utils.bootstrap-model-wrapper>
    <div class="row" style="padding: 3px 10px;">
        <div class="col-md-12"><h4 class="header-title pb-3 pt-3"></h4></div>
        <div class="col-md-12 lab-result-request-form-wrapper"></div>  
    </div>
</x-utils.bootstrap-model-wrapper>