<div class="row">

    <div class="col-md-12">
        <b>Lab Status: </b>
        @include('enforcements.tasks.drc.partials.lab-status',['labStatus' => $application->drcActionRecord->lab_status ])
    </div>

    @if( $application->drcActionRecord->assigned_officer_id === auth()->user()->id && ('to_request' === $application->drcActionRecord->lab_status || is_null($application->drcActionRecord->lab_status) ) && auth()->user()->hasPermission('drc','request-lab-result') )
       <div class="col-md-12 mt-3">
            @include('enforcements.tasks.drc.partials.lab-request-btn',[
            'redirectUrl' => url()->current() . '#lab-information',
            'url' => route('tasks.drc.lab_result_request_form',['drcApplication' => $application]),
            'title' => 'Lab Result Request for Application No: ' . ($application->application_no??'') 
            ])
        </div>         
    @endif

    @if( $application->drcActionRecord->assigned_officer_id === auth()->user()->id && 'received' === $application->drcActionRecord->lab_status )              
        <div class="col-md-12 mt-3">
            @include('enforcements.tasks.drc.partials.lab-decision-btn',[
               'redirectUrl' => url()->current() . '#lab-information' ,
               'decisiondUrl' => route('tasks.drc.set_lab_result', ['drcApplication' => $application])
            ])
        </div>
    @endif

</div>