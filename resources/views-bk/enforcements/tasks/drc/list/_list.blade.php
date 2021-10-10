<?php
   $cols = [
       'No.',
       'Application No.',
       'Registration Fee Status',
       'Lab Status',
       'ATC Code',
       'Generic Name',
       'Therapeutic Class',
       'Application Date',
       'Officer',
       'Action'
    ];
    $status = request('applicationStatus');
    switch ($status) {
        case 'approved':
            $cols[1] = 'Certificate No';
            $cols[7] = 'Approved Date';
            break;
        case 'rejected':
            $cols[7] = 'Rejected Date';
            break;
        case 'auto-cancelled':
            $cols[7] = 'Cancelled At';
            break;
        default:
            $cols[7] = 'Application Date';
            break;
    }
?>

<x-utils.data-table class="table" :ths="$cols">

    @php
      $lists->perPage(['drcActionRecord']);
      $indexer = $lists->perPage() * $lists->currentPage() - $lists->perPage();
      $viewPermission = auth()->user()->hasPermission('drc', 'view');
      $approvePermission = auth()->user()->hasPermission('drc', 'approve');
      $rejectPermission = auth()->user()->hasPermission('drc', 'reject');
      $viewApprovedCertificatePermission = auth()->user()->hasPermission('drc', 'view-approved-certificate');
    @endphp

    @foreach ($lists as $k => $list)
        @php
          $isMyTask = $list->drcActionRecord->assigned_officer_id === auth()->user()->id;
        @endphp
        <tr>
            <td>{{ $k + 1 + $indexer }}.</td>
            <td>{{ $list->application_status == 'approved' ? $list->certificate_no : $list->application_no }}</td>
           <td>
            @if( $list->registration_fee === 'pending' )
                <span class="text-danger"><i class="fa fa-circle-o" aria-hidden="true"></i> Not Requested</span>
              @elseif( $list->registration_fee === 'requested' )
                <span class="text-info"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> Requested</span>
              @elseif( $list->registration_fee === 'paid' )
                <span class="text-success"><i class="fa fa-check" aria-hidden="true"></i> Paid</span>
              @endif

               @if($isMyTask && $list->registration_fee == 'pending' && auth()->user()->hasPermission('drc','pay-registration-fee'))
                    @include('enforcements.tasks.drc.partials.registration-fee-request-btn',[
                        'redirectUrl' => url()->full(),
                        'url' => route('tasks.drc.request_reg_fee',['drcApplication' => $list]),
                    ])
               @endif
           </td>
           <td>
           @include('enforcements.tasks.drc.partials.lab-status',['labStatus' => $list->drcActionRecord->lab_status ])

           @if( $isMyTask && 'to_request' === $list->drcActionRecord->lab_status && auth()->user()->hasPermission('drc', 'request-lab-result') )
                @include('enforcements.tasks.drc.partials.lab-request-btn',[
                    'redirectUrl' => url()->current() . '#lab-information',
                    'url' => route('tasks.drc.lab_result_request_form',['drcApplication' => $list]),
                    'title' => 'Lab Result Request for Application No: ' . ($list->application_no??'')
                ])
           @endif
           @if( $isMyTask && 'received' === $list->drcActionRecord->lab_status )
            @include('enforcements.tasks.drc.partials.lab-decision-btn',[
               'redirectUrl' => url()->current() . '#lab-information' ,
               'decisiondUrl' => route('tasks.drc.set_lab_result', ['drcApplication' => $list])
            ])
           @endif
           </td>

            <td>{{ $list->atc_code }}</td>
            <td>{{ $list->generic_name }}</td>
            <td>{{ $list->therapeutic_class }}</td>
            <td>
                @if($status == 'approved')
                    {{ optional($list->drcActionRecord)->approved_at }}
                @elseif($status == 'rejected')
                    {{ optional($list->drcActionRecord)->rejected_at }}
                @elseif($status == 'auto-cancelled')
                    {{ optional($list->drcActionRecord)->auto_cancelled_at }}
                @else
                    {{ optional($list->drcActionRecord)->submitted_at }}
                @endif
            </td>
            <td>{{ optional($list->drcActionRecord->user)->name }}</td>
            <td>
                @if( $viewPermission )
                    <a class="btn btn-warning btn-sm mt-1" href="{{ route('tasks.drc.show', ['drcApplication' => $list]) }}">View</a>
                @endif

                @if( in_array($list->application_status, ['submitted','resubmitted']) )
                    @if( $approvePermission && $list->drcActionRecord->decision_status === 'approvable' )
                        <a class="btn btn-success btn-sm mt-1 director-decision-on-list-btn"
                           href="{{ route('tasks.drc.approve', ['drcApplication'=> $list]) }}"
                           active-btn-class="btn-success"
                           inactive-btn-class="btn-danger no-alert"
                           subject="Approval"
                           redirect-url="{{ request()->fullUrl() }}"
                           body="Application No.({{ $list->application_no }}) has been approved.">Approve</a>
                    @endif
                    @if( $rejectPermission && $list->drcActionRecord->decision_status === 'rejectable' )
                        <a class="btn btn-danger no-alert btn-sm mt-1 director-decision-on-list-btn"
                           href="{{ route('tasks.drc.reject', ['drcApplication'=> $list]) }}"
                           active-btn-class="btn-danger no-alert"
                           inactive-btn-class="btn-success"
                           subject="Rejection"
                           redirect-url="{{ request()->fullUrl() }}"
                           body="Application No.({{ $list->application_no }}) has been rejected.">Reject</a>
                    @endif
                @endif

                @if( $list->isApproved() && $viewApprovedCertificatePermission )
                    @if($list->drcActionRecord->certificate_file_id)
                        @php
                            $showFileUr = route('tasks.drc.view_approved_certificate',['file' => $list->drcActionRecord->certificate_file_id]);
                        @endphp
                    @endif
                    <a class="btn btn-success btn-sm mt-1" onclick="window.open('{{ $showFileUr }}', '_blank', 'fullscreen=yes'); return false;"
                       href="{{ $showFileUr }}">View Certificate</a>
                @endif
            </td>
        </tr>
    @endforeach

</x-utils.data-table>

<!-- Lab Result Request Form Container -->
<x-utils.bootstrap-model-wrapper>
    <div class="row" style="padding: 3px 10px;">
        <div class="col-md-12"><h4 class="header-title pb-3 pt-3"></h4></div>
        <div class="col-md-12 lab-result-request-form-wrapper"></div>
    </div>
</x-utils.bootstrap-model-wrapper>

<!--For Clicking Approve Button or Reject Button on the list by Director. -->
@if( $rejectPermission || $approvePermission )
    <x-officer-actions.approve-reject-on-list></x-officer-actions.approve-reject-on-list>
@endif

{{ $lists->appends(request()->all()) }}
