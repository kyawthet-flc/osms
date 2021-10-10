<?php
    $conditinalDate = '';
    if( request('applicationStatus') === 'incomplete' ) {
        $conditinalDate = 'Incomplete Date';
    } elseif( request('applicationStatus') === 'auto-cancelled' ) {
        $conditinalDate = 'Auto Cancelled Date';        
    } elseif( request('applicationStatus') === 'rejected' ) {
        $conditinalDate = 'Rejected Date';
    } elseif( request('applicationStatus') === 'license-approved' ) {
        $conditinalDate = 'Approved Date';
    } elseif( request('applicationStatus') === 'approved' ) {
        $conditinalDate = 'Approved Date';
    }

    if( in_array(request('applicationStatus'),['submitted', 'resubmitted']) ) {
         $cols = [
            'No.', 'Application No.', 'Factory Name', 'Dosage Form Type', 'Application Date', 'Officer', 'Action'
          ];
    }else {
        $cols = [
            'No.', 'Application No.', 'Factory Name', 'Dosage Form Type', $conditinalDate, 'Officer', 'Action'
          ];
    }
    
?>

<x-utils.data-table class="table" :ths="$cols">

    @php
      $indexer = $lists->perPage() * $lists->currentPage() - $lists->perPage();
      $viewPermission = auth()->user()->hasPermission('dlmc', 'view');
      $approvePermission = auth()->user()->hasPermission('dlmc', 'approve');
      $tempPermission = auth()->user()->hasPermission('dlmc', 'approve-temp-license');
      $previewCertificatePermission = auth()->user()->hasPermission('dlmc', 'preview-certificate');
      $rejectPermission = auth()->user()->hasPermission('dlmc', 'reject');
    @endphp

    @foreach ($lists as $k => $list)
        <tr>
            <td>{{ $k + 1 + $indexer }}.</td>
            <td>{{ $list->application_no }}</td>
            <td>{{ $list->manufacturer_name }}</td>
            <td>
                {{ $list->dlmcDrugsToProduce->dosage_type?? 'N\A' }}
            </td>
            @if( !in_array(request('applicationStatus'),['submitted', 'resubmitted']) )
                <td>
                    @if( request('applicationStatus') === 'incomplete' )
                        {{ optional($list->dlmcActionRecord)->incomplete_at }}
                    @elseif( request('applicationStatus') === 'auto-cancelled' )
                        {{ optional($list->dlmcActionRecord)->auto_cancelled_at }}
                    @elseif( request('applicationStatus') === 'rejected' )
                        {{ optional($list->dlmcActionRecord)->rejected_at }}
                    @elseif( request('applicationStatus') === 'approved' )
                        {{ optional($list->dlmcActionRecord)->approved_at }}
                    @elseif( request('applicationStatus') === 'license-approved' )
                        {{ optional($list->dlmcActionRecord)->temp_license_at }}
                    @endif
                </td>
            @else 
                <td>{{ optional($list->dlmcActionRecord)->submitted_at }}</td>
            @endif
            <td>{{ optional($list->dlmcActionRecord->user)->name }}</td>
            <td class="text-center">
                <!-- // has view permission -->
                @if( $viewPermission )
                    <a class="btn btn-warning btn-sm mb-2" href="{{ route('tasks.dlmc.show', ['dlmcApplication' => $list]) }}">View</a>
                @endif
                @if( in_array($list->application_status, ['submitted','resubmitted', 'license-approved']) )
                    @if( $approvePermission && $list->dlmcActionRecord->decision_status === 'approvable' && !is_null($list->dlmcActionRecord->temp_license_file_id) )
                        <br>
                        <a class="btn btn-success btn-sm mb-2 director-decision-on-list-btn" 
                        href="{{ route('tasks.dlmc.approve', ['dlmcApplication'=> $list]) }}" 
                        active-btn-class="btn-success" 
                        inactive-btn-class="btn-danger no-alert" 
                        subject="Approval" 
                        redirect-url="{{ request()->fullUrl() }}"
                        body="Application No.({{ $list->application_no }}) has been approved.">Approve</a>

                        @if( $previewCertificatePermission )
                            <br>
                            <a class="btn btn-info btn-sm mb-2" 
                            onclick="window.open('{{ route('tasks.dlmc.preview_certificate',['dlmcApplication' => $list]) }}', '_blank', 'fullscreen=yes'); return false;"  href="{{ route('tasks.dlmc.preview_certificate',['dlmcApplication' => $list]) }}">Preview Certificate</a>
                        @endif
                    @elseif ($tempPermission && $list->dlmcActionRecord->decision_status === 'approvable')
                    
                        @if ( is_null($list->dlmcActionRecord->temp_license_file_id) )    
                            <br>
                            <a class="btn btn-success btn-sm mb-2 director-decision-on-list-btn" 
                            href="{{ route('tasks.dlmc.approve_license', ['dlmcApplication'=> $list]) }}" 
                            active-btn-class="btn-success" 
                            inactive-btn-class="btn-danger no-alert" 
                            subject="Approval Temporary License" 
                            redirect-url="{{ request()->fullUrl() }}"
                            body="Application No.({{ $list->application_no }}) has been approved Temporary License.">Approve Temp License</a>
                            
                            <br>
                            <a class="btn btn-info btn-sm mb-2" 
                            onclick="window.open('{{ route('tasks.dlmc.preview_license',['dlmcApplication' => $list]) }}', '_blank', 'fullscreen=yes'); return false;"  href="{{ route('tasks.dlmc.preview_license',['dlmcApplication' => $list]) }}">Preview License</a>
                        @endif
                    @endif
                    @if( $rejectPermission && $list->dlmcActionRecord->decision_status === 'rejectable' )
                        <br>
                        <a class="btn btn-danger no-alert btn-sm mb-2 director-decision-on-list-btn" 
                        href="{{ route('tasks.dlmc.reject', ['dlmcApplication'=> $list]) }}" 
                        active-btn-class="btn-danger no-alert" 
                        inactive-btn-class="btn-success" 
                        subject="Rejection" 
                        redirect-url="{{ request()->fullUrl() }}"
                        body="Application No.({{ $list->application_no }}) has been rejected.">Reject</a>
                    @endif
                @endif
                @if($list->dlmcActionRecord->certificate_file_id)
                    @php 
                        $showFileUr = route('tasks.dlmc.view_approved_certificate',['file' => $list->dlmcActionRecord->certificate_file_id]);
                    @endphp
                    <br>
                    <a class="btn btn-success btn-sm mb-2" onclick="window.open('{{ $showFileUr }}', '_blank', 'fullscreen=yes'); return false;" 
                        href="{{ $showFileUr }}">View Certificate</a>
                @endif
                @if($list->dlmcActionRecord->temp_license_file_id)
                    @php 
                        $showFileUr = route('tasks.dlmc.view_approved_certificate',['file' => $list->dlmcActionRecord->temp_license_file_id]);
                    @endphp
                    <br>
                    <a class="btn btn-success btn-sm" onclick="window.open('{{ $showFileUr }}', '_blank', 'fullscreen=yes'); return false;" 
                        href="{{ $showFileUr }}">View License</a>
                @endif
            </td>
        </tr>
    @endforeach

</x-utils.data-table>

@if( $rejectPermission || $approvePermission )
  <x-officer-actions.approve-reject-on-list></x-officer-actions.approve-reject-on-list>
@endif

{{ $lists->appends(request()->all()) }}
