<?php
   $cols = [
       'No.', 
       'Application No.',
       'Type Of Procedure.',
       'Brand Name', 
       'Importer Name', 
       'Telephone No.',
       'Application Date',
       'Officer', 
       'Action'
    ];
?>
<x-utils.data-table class="table-responsive" :ths="$cols">
    
    @php
      $indexer = $lists->perPage() * $lists->currentPage() - $lists->perPage();
      $viewPermission = auth()->user()->hasPermission('onetime', 'view');
      $approvePermission = auth()->user()->hasPermission('onetime', 'approve');
      $rejectPermission = auth()->user()->hasPermission('onetime', 'reject');
      $viewApprovedCertificatePermission = auth()->user()->hasPermission('onetime', 'view-approved-certificate');
    @endphp
 
    @foreach ($lists as $k => $list)
        <tr>
            <td>{{ $k + 1 + $indexer }}.</td>
            <td>{{ $list->application_no }}</td>
            <td>{{ $list->type_of_procedure }}</td>
            <td>
                @foreach($list->onetimeProductLists as $oneProduct)
                * {{$oneProduct->brand_name}}<br>
                @endforeach
            </td>
            <td>{{ $list->importer_name }}</td>
            <td>{{ $list->phone }}</td>
            <td>{{ optional($list->onetimeActionRecord)->submitted_at }}</td>
            <td>{{ optional($list->onetimeActionRecord->user)->name }}</td>
            <td>
                @if( $viewPermission )
                    <a class="btn btn-warning btn-sm mt-1" href="{{ route('tasks.onetime.show', ['onetimeApplication' => $list->id]) }}">View</a>
                @endif

                @if( in_array($list->application_status, ['submitted','resubmitted']) )
                    @if( $approvePermission && $list->onetimeActionRecord->decision_status === 'approvable' )
                        <a class="btn btn-success btn-sm mt-1 director-decision-on-list-btn" 
                        href="{{ route('tasks.onetime.approve', ['onetimeApplication'=> $list]) }}" 
                        active-btn-class="btn-success" 
                        inactive-btn-class="btn-danger no-alert" 
                        subject="Approval" 
                        redirect-url="{{ request()->fullUrl() }}"
                        body="Application No.({{ $list->application_no }}) has been approved.">Approve</a>
                    @endif
                    @if( $rejectPermission && $list->onetimeActionRecord->decision_status === 'rejectable' )
                        <a class="btn btn-danger no-alert btn-sm mt-1 director-decision-on-list-btn" 
                        href="{{ route('tasks.onetime.reject', ['onetimeApplication'=> $list]) }}" 
                        active-btn-class="btn-danger no-alert" 
                        inactive-btn-class="btn-success" 
                        subject="Rejection" 
                        redirect-url="{{ request()->fullUrl() }}"
                        body="Application No.({{ $list->application_no }}) has been rejected.">Reject</a>
                    @endif
                @endif

                @if( $list->isApproved() && $viewApprovedCertificatePermission )
                @if($list->onetimeActionRecord->certificate_file_id)
                @php 
                   $showFileUr = route('tasks.onetime.view_approved_certificate',['file' => $list->onetimeActionRecord->certificate_file_id]);
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