<?php
    $conditinalDate = '';
    if( request('applicationStatus') === 'incomplete' ) {
        $conditinalDate = 'Incomplete Date';
    } elseif( request('applicationStatus') === 'auto-cancelled' ) {
        $conditinalDate = 'Auto Cancelled Date';        
    } elseif( request('applicationStatus') === 'rejected' ) {
        $conditinalDate = 'Rejected Date';
    } elseif( request('applicationStatus') === 'approved' ) {
        $conditinalDate = 'Approved Date';
    }
    $cols = [
       'No.', 'Application No.', 'Applicant Name',  'Business Name',  'Business Telephone No.', 'Application Date', $conditinalDate, 'Officer', 'Action'
    ];

    if( in_array(request('applicationStatus'),['submitted', 'resubmitted']) ) {
        $cols = [
            'No.', 'Application No.', 'Applicant Name',  'Business Name',  'Business Telephone No.', 'Application Date', 'Officer', 'Action'
         ];
    }
?>

<x-utils.data-table class="table" :ths="$cols">
    
    @php
      $indexer = $lists->perPage() * $lists->currentPage() - $lists->perPage();
      $viewPermission = auth()->user()->hasPermission('diac', 'view');
      $approvePermission = auth()->user()->hasPermission('diac', 'approve');
      $previewCertificatePermission = auth()->user()->hasPermission('diac', 'preview-certificate');
      $rejectPermission = auth()->user()->hasPermission('diac', 'reject');
      $viewApprovedCertificatePermission = auth()->user()->hasPermission('diac', 'view-approved-certificate');
    @endphp

    @foreach ($lists as $k => $list)
        <tr>
            <td>{{ $k + 1 + $indexer }}.</td>
            <td>{{ $list->application_no }}</td>
            <td>{{ $list->applicant_name }}</td>
            <td>{{ $list->business_name }}</td>
            <td>{{ $list->business_tele_no }}</td>            
            
            <td>{{ optional($list->diacActionRecord)->submitted_at }}</td>
            @if( !in_array(request('applicationStatus'),['submitted', 'resubmitted']) )
                <td>
                @if( request('applicationStatus') === 'incomplete' )
                {{ optional($list->diacActionRecord)->incomplete_at }}
                @elseif( request('applicationStatus') === 'auto-cancelled' )
                {{ optional($list->diacActionRecord)->auto_cancelled_at }}
                @elseif( request('applicationStatus') === 'rejected' )
                {{ optional($list->diacActionRecord)->rejected_at }}
                @elseif( request('applicationStatus') === 'approved' )
                {{ optional($list->diacActionRecord)->approved_at }}
                @endif
                </td>
            @endif
            <td>{{ optional($list->diacActionRecord->user)->name }}</td>
            <td>
                @if( $viewPermission )
                    <a class="btn btn-warning btn-sm mt-1" href="{{ route('tasks.diac.show', ['diacApplication' => $list]) }}">View</a>
                @endif

                @if( in_array($list->application_status, ['submitted','resubmitted']) )
                    @if( $approvePermission && $list->diacActionRecord->decision_status === 'approvable' )
                        <a class="btn btn-success btn-sm mt-1 director-decision-on-list-btn" 
                        href="{{ route('tasks.diac.approve', ['diacApplication'=> $list]) }}" 
                        active-btn-class="btn-success" 
                        inactive-btn-class="btn-danger no-alert" 
                        subject="Approval" 
                        redirect-url="{{ request()->fullUrl() }}"
                        body="Application No.({{ $list->application_no }}) has been approved.">Approve</a>

                        @if( $previewCertificatePermission )
                         <a class="btn btn-info btn-sm mt-1" 
                         onclick="window.open('{{ route('tasks.diac.preview_certificate',['diacApplication' => $list]) }}', '_blank', 'fullscreen=yes'); return false;"  href="{{ route('tasks.diac.preview_certificate',['diacApplication' => $list]) }}">Preview Certificate</a>
                        @endif
                    @endif
                    @if( $rejectPermission && $list->diacActionRecord->decision_status === 'rejectable' )
                        <a class="btn btn-danger no-alert btn-sm mt-1 director-decision-on-list-btn" 
                        href="{{ route('tasks.diac.reject', ['diacApplication'=> $list]) }}" 
                        active-btn-class="btn-danger no-alert" 
                        inactive-btn-class="btn-success" 
                        subject="Rejection" 
                        redirect-url="{{ request()->fullUrl() }}"
                        body="Application No.({{ $list->application_no }}) has been rejected.">Reject</a>
                    @endif
                @endif

                @if( $list->isApproved() && $viewApprovedCertificatePermission )
                @if($list->diacActionRecord->certificate_file_id)
                @php 
                   $showFileUr = route('tasks.diac.view_approved_certificate',['file' => $list->diacActionRecord->certificate_file_id]);
                @endphp
                 @endif
                <a class="btn btn-success btn-sm mt-1" onclick="window.open('{{ $showFileUr }}', '_blank', 'fullscreen=yes'); return false;" 
                href="{{ $showFileUr }}">View Certificate</a>
                @endif

            </td>
        </tr>
    @endforeach

</x-utils.data-table>
<!-- 
    For Clicking Approve Button or Reject Button on the list by Director.
 -->
@if( $rejectPermission || $approvePermission )
  <x-officer-actions.approve-reject-on-list></x-officer-actions.approve-reject-on-list>
@endif

{{ $lists->appends(request()->all()) }}