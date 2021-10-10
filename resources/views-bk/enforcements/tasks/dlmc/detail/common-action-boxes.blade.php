@if( in_array($application->application_status,['submitted', 'resubmitted', 'license-approved']) )
<x-officer-actions.to-approve
 :attrs="[
    'actionUrl' => route('tasks.dlmc.to_approve', ['dlmcApplication' => $application]),
    'subject' => 'To Approve',
    'body' => '',
  ]"></x-officer-actions.to-approve>

<x-officer-actions.local-payment
 :attrs="[
    'actionUrl' => route('tasks.dlmc.make_payment', ['dlmcApplication' => $application]),
    'subject' => 'Pay Registration Fee',
    'amount' => '',
    'body' => '',
  ]"></x-officer-actions.local-payment>

<x-officer-actions.inspection
 :attrs="[
    'actionUrl' => route('tasks.dlmc.inspection_notice', ['dlmcApplication' => $application]),
    'subject' => 'Inspection Notice',
    'body' => '',
  ]"></x-officer-actions.inspection>

<x-officer-actions.preview-certificate :attrs="[
    'actionUrl' => route('tasks.dlmc.preview_certificate', ['dlmcApplication'=> $application]),
    'subject' => 'Preview Cerificate',
    'body' => '',
  ]"></x-officer-actions.preview-certificate>

  <x-officer-actions.approve :attrs="[
    'actionUrl' => route('tasks.dlmc.approve', ['dlmcApplication'=> $application]),
    'subject' => 'Approval',
    'body' => '',
  ]"></x-officer-actions.approve>

  <x-officer-actions.approve-license :attrs="[
    'actionUrl' => route('tasks.dlmc.approve_license', ['dlmcApplication'=> $application]),
    'subject' => 'Approval Temporary License',
    'body' => '',
  ]"></x-officer-actions.approve-license>


<x-officer-actions.comment :attrs="[
    'actionUrl' => route('tasks.dlmc.comment', ['dlmcApplication'=> $application]),
    'subject' => NULL,
    'body' => '',
  ]"></x-officer-actions.comment>

<x-officer-actions.to-reject :attrs="[
    'actionUrl' => route('tasks.dlmc.to_reject', ['dlmcApplication' => $application]),
    'subject' => 'To Reject',
    'body' => '',
  ]"></x-officer-actions.to-reject>

<x-officer-actions.preview-rejection :attrs="[
    'actionUrl' => route('tasks.dlmc.preview_certificate', ['dlmcApplication'=> $application]),
    'subject' => 'Preview Rejection',
    'body' => '',
  ]"></x-officer-actions.preview-rejection>

<x-officer-actions.reject :attrs="[
    'actionUrl' => route('tasks.dlmc.reject', ['dlmcApplication'=> $application]),
    'subject' => 'Rejection',
    'body' => '',
  ]">></x-officer-actions.reject>

<x-officer-actions.incomplete :attrs="[
    'actionUrl' => route('tasks.dlmc.incomplete', ['dlmcApplication'=> $application]),
    'subject' => 'Incomplete',
    'body' => '',
  ]"></x-officer-actions.incomplete>

<x-officer-actions.auto-cancel :attrs="[
    'actionUrl' => route('tasks.dlmc.auto_cancel', ['dlmcApplication'=> $application]),
    'subject' => 'Auto Cancellation',
    'body' => '',
  ]"></x-officer-actions.auto-cancel>
@endif
