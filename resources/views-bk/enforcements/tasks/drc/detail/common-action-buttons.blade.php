<!--
    Comment, Incomplete, Auto Cancel, Approve, Reject
 -->
@if( in_array($application->application_status,['submitted', 'resubmitted']) )
<?php
   $showCommentButton = auth()->user()->hasPermission('drc', 'comment');
   $showAutoCancelButton = auth()->user()->hasPermission('drc', 'auto-cancel');
   $showIncompleteButton = auth()->user()->hasPermission('drc', 'incomplete');

   $showToRejectButton = auth()->user()->hasPermission('drc', 'to-reject');
   $showPreviewRejectionButton = auth()->user()->hasPermission('drc', 'preview-rejection');

   $showRejectButton = auth()->user()->hasPermission('drc', 'reject') && $application->drcActionRecord->decision_status === 'rejectable';

   $showToApproveButton = auth()->user()->hasPermission('drc', 'to-approve');
   $showPreviewCertificateButton = auth()->user()->hasPermission('drc', 'preview-certificate');
   $showPaymentButton = auth()->user()->hasPermission('drc', 'pay-registration-fee') && $application->registration_fee === 'pending';

   $showApproveButton = auth()->user()->hasPermission('drc', 'approve') && $application->drcActionRecord->decision_status === 'approvable';
   $incompleteCounter = (new App\Model\GeneralSetup\Period)->incompleteCounter($application->application_module_id, $application->application_type);

?>

 <x-officer-actions.buttons-wrapper
    :attrs="[
      'show-comment-button' => $showCommentButton,

      'show-to-approve-button' => $showToApproveButton,
      'show-preview-certificate-button' => $showPreviewCertificateButton,
      'show-approve-button' => $showApproveButton,

      'show-to-reject-button' => $showToRejectButton,
      'show-preview-rejection-button' => $showPreviewRejectionButton,
      'show-reject-button' => $showRejectButton,

      'show-auto-cancel-button' => $showAutoCancelButton,
      'show-incomplete-button' => $showIncompleteButton,
      'show-payment-button' => $showPaymentButton,
      'show-incomplete-time' => $incompleteCounter,
      'show-incomplete-diabled' => !($application->drcActionRecord->incomplete_counter < $incompleteCounter),
      'show-incomplete-msg' => 'Incomplete '. $incompleteCounter .'Time(s) already.',
    ]">

 </x-officer-actions.buttons-wrapper>

 @endif
