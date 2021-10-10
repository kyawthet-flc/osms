@if( in_array($application->application_status,['submitted', 'resubmitted']) )
<x-officer-actions.to-approve
 :attrs="[
    'actionUrl' => route('tasks.drc.to_approve', ['drcApplication' => $application]),
    'subject' => 'To Approve',
    'body' => '',
  ]"></x-officer-actions.to-approve>

<x-officer-actions.preview-certificate :attrs="[
    'actionUrl' => route('tasks.drc.preview_certificate', ['drcApplication'=> $application]),
    'subject' => 'Preview Cerificate',
    'body' => '',
  ]"></x-officer-actions.preview-certificate>

<x-officer-actions.approve :attrs="[
    'actionUrl' => route('tasks.drc.approve', ['drcApplication'=> $application]),
    'subject' => 'Approval',
    'body' => '',
  ]"></x-officer-actions.approve>

<x-officer-actions.comment :attrs="[
    'actionUrl' => route('tasks.drc.comment', ['drcApplication'=> $application]),
    'subject' => NULL,
    'body' => '',
  ]"></x-officer-actions.comment>

<x-officer-actions.to-reject :attrs="[
    'actionUrl' => route('tasks.drc.to_reject', ['drcApplication' => $application]),
    'subject' => 'To Reject',
    'body' => '',
  ]"></x-officer-actions.to-reject>

<x-officer-actions.preview-rejection :attrs="[
    'actionUrl' => route('tasks.drc.preview_certificate', ['drcApplication'=> $application]),
    'subject' => 'Preview Rejection',
    'body' => '',
  ]"></x-officer-actions.preview-rejection>

<x-officer-actions.reject :attrs="[
    'actionUrl' => route('tasks.drc.reject', ['drcApplication'=> $application]),
    'subject' => 'Rejection',
    'body' => '',
  ]">></x-officer-actions.reject>

<x-officer-actions.incomplete :attrs="[
    'actionUrl' => route('tasks.drc.incomplete', ['drcApplication'=> $application]),
    'subject' => 'Incomplete',
    'body' => '',
  ]"></x-officer-actions.incomplete>

<x-officer-actions.auto-cancel :attrs="[
    'actionUrl' => route('tasks.drc.auto_cancel', ['drcApplication'=> $application]),
    'subject' => 'Auto Cancellation',
    'body' => '',
  ]"></x-officer-actions.auto-cancel>

<x-officer-actions.payment :attrs="[
    'actionUrl' => route('tasks.drc.request_reg_fee', ['drcApplication'=> $application]),
    'subject' => 'Request Registration Fee',
    'body' => '',
  ]"></x-officer-actions.payment>
@endif
