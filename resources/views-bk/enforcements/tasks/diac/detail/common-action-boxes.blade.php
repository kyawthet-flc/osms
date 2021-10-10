@if( in_array($application->application_status,['submitted', 'resubmitted']) )
<x-officer-actions.to-approve 
 :attrs="[
    'actionUrl' => route('tasks.diac.to_approve', ['diacApplication' => $application]),
    'subject' => 'To Approve',
    'body' => '',
  ]"></x-officer-actions.to-approve>

<x-officer-actions.preview-certificate :attrs="[
    'actionUrl' => route('tasks.diac.preview_certificate',['diacApplication' => $application]),
    'subject' => 'Preview Cerificate',
    'body' => '',
  ]"></x-officer-actions.preview-certificate>

<x-officer-actions.approve :attrs="[
    'actionUrl' => route('tasks.diac.approve', ['diacApplication'=> $application]),
    'subject' => 'Approval',
    'body' => '',
  ]"></x-officer-actions.approve>

<x-officer-actions.comment :attrs="[
    'actionUrl' => route('tasks.diac.comment', ['diacApplication'=> $application]),
    'subject' => NULL,
    'body' => '',
  ]"></x-officer-actions.comment>

<x-officer-actions.to-reject :attrs="[
    'actionUrl' => route('tasks.diac.to_reject', ['diacApplication' => $application]),
    'subject' => 'To Reject',
    'body' => '',
  ]"></x-officer-actions.to-reject>

<x-officer-actions.preview-rejection :attrs="[
    'actionUrl' => route('tasks.diac.preview_certificate', ['diacApplication'=> $application]),
    'subject' => 'Preview Rejection',
    'body' => '',
  ]"></x-officer-actions.preview-rejection>

<x-officer-actions.reject :attrs="[
    'actionUrl' => route('tasks.diac.reject', ['diacApplication'=> $application]),
    'subject' => 'Rejection',
    'body' => '',
  ]">></x-officer-actions.reject>

<x-officer-actions.incomplete :attrs="[
    'actionUrl' => route('tasks.diac.incomplete', ['diacApplication'=> $application]),
    'subject' => 'Incomplete',
    'body' => '',
  ]"></x-officer-actions.incomplete>

<x-officer-actions.auto-cancel :attrs="[
    'actionUrl' => route('tasks.diac.auto_cancel', ['diacApplication'=> $application]),
    'subject' => 'Auto Cancellation',
    'body' => '',
  ]"></x-officer-actions.auto-cancel>
@endif