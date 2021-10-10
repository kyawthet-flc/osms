<!-- 
    Comment, Incomplete, Auto Cancel, Approve, Reject
 -->
@if( in_array($application->application_status,['submitted', 'resubmitted']) )
<?php
   $showCommentButton = auth()->user()->hasPermission('diac', 'comment');
   $showAutoCancelButton = auth()->user()->hasPermission('diac', 'auto-cancel');
   $showIncompleteButton = auth()->user()->hasPermission('diac', 'incomplete');
   
   $showToRejectButton = auth()->user()->hasPermission('diac', 'to-reject');
   $showPreviewRejectionButton = auth()->user()->hasPermission('diac', 'preview-rejection');
   
   $showRejectButton = auth()->user()->hasPermission('diac', 'reject') && $application->diacActionRecord->decision_status === 'rejectable';

   $showToApproveButton = auth()->user()->hasPermission('diac', 'to-approve');
   $showPreviewCertificateButton = auth()->user()->hasPermission('diac', 'preview-certificate');

   $showApproveButton = auth()->user()->hasPermission('diac', 'approve') && $application->diacActionRecord->decision_status === 'approvable';
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
      'show-incomplete-time' => $incompleteCounter,
      'show-incomplete-diabled' => !($application->diacActionRecord->incomplete_counter < $incompleteCounter),
      'show-incomplete-msg' => 'Incomplete '. $incompleteCounter .'Time(s) already.',
    ]">

 </x-officer-actions.buttons-wrapper>

 @endif