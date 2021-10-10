<!-- 
    Comment, Incomplete, Auto Cancel, Approve, Reject
 -->
@if( in_array($application->application_status,['submitted', 'resubmitted']) )
<?php
   $showCommentButton = auth()->user()->hasPermission('onetime', 'comment');
   $showAutoCancelButton = auth()->user()->hasPermission('onetime', 'auto-cancel');
   $showIncompleteButton = auth()->user()->hasPermission('onetime', 'incomplete');
   
   $showToRejectButton = auth()->user()->hasPermission('onetime', 'to-reject');
   $showPreviewRejectionButton = auth()->user()->hasPermission('onetime', 'preview-rejection');
   
   $showRejectButton = auth()->user()->hasPermission('onetime', 'reject') && $application->onetimeActionRecord->decision_status === 'rejectable';

   $showToApproveButton = auth()->user()->hasPermission('onetime', 'to-approve');
   $showPreviewCertificateButton = auth()->user()->hasPermission('onetime', 'preview-certificate');

   $showApproveButton = auth()->user()->hasPermission('onetime', 'approve') && $application->onetimeActionRecord->decision_status === 'approvable';
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

      'show-incomplete-time' => (new App\Model\GeneralSetup\Period)->incompleteCounter($application->application_module_id, $application->application_type),
      'show-incomplete-diabled' => !($application->onetimeActionRecord->incomplete_counter < (new App\Model\GeneralSetup\Period)->incompleteCounter($application->application_module_id, $application->application_type)),
      'show-incomplete-msg' => 'Incomplete '.(new App\Model\GeneralSetup\Period)->incompleteCounter($application->application_module_id, $application->application_type).'Time(s) already.',
    ]">

 </x-officer-actions.buttons-wrapper>

 @endif