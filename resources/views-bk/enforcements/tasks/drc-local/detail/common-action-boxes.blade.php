@if( in_array($application->application_status,['submitted', 'resubmitted']) )
<x-officer-actions.to-approve
 :attrs="[
    'actionUrl' => route('tasks.drc_local.to_approve', ['drcApplication' => $application]),
    'subject' => 'To Approve',
    'body' => '',
  ]"></x-officer-actions.to-approve>

<x-officer-actions.preview-certificate :attrs="[
    'actionUrl' => route('tasks.drc_local.preview_certificate', ['drcApplication'=> $application]),
    'subject' => 'Preview Cerificate',
    'body' => '',
  ]"></x-officer-actions.preview-certificate>

<x-officer-actions.approve :attrs="[
    'actionUrl' => route('tasks.drc_local.approve', ['drcApplication'=> $application]),
    'subject' => 'Approval',
    'body' => '',
  ]"></x-officer-actions.approve>

<x-officer-actions.comment :attrs="[
    'actionUrl' => route('tasks.drc_local.comment', ['drcApplication'=> $application]),
    'subject' => NULL,
    'body' => '',
  ]"></x-officer-actions.comment>

<x-officer-actions.to-reject :attrs="[
    'actionUrl' => route('tasks.drc_local.to_reject', ['drcApplication' => $application]),
    'subject' => 'To Reject',
    'body' => '',
  ]"></x-officer-actions.to-reject>

<x-officer-actions.preview-rejection :attrs="[
    'actionUrl' => route('tasks.drc_local.preview_certificate', ['drcApplication'=> $application]),
    'subject' => 'Preview Rejection',
    'body' => '',
  ]"></x-officer-actions.preview-rejection>

<x-officer-actions.reject :attrs="[
    'actionUrl' => route('tasks.drc_local.reject', ['drcApplication'=> $application]),
    'subject' => 'Rejection',
    'body' => '',
  ]">></x-officer-actions.reject>

<x-officer-actions.incomplete :attrs="[
    'actionUrl' => route('tasks.drc_local.incomplete', ['drcApplication'=> $application]),
    'subject' => 'Incomplete',
    'body' => '',
  ]"></x-officer-actions.incomplete>

<x-officer-actions.auto-cancel :attrs="[
    'actionUrl' => route('tasks.drc_local.auto_cancel', ['drcApplication'=> $application]),
    'subject' => 'Auto Cancellation',
    'body' => '',
  ]"></x-officer-actions.auto-cancel>
@endif
