<!--
    Comment, Incomplete, Auto Cancel, Approve, Reject
 -->
@if( in_array($application->application_status,['submitted', 'resubmitted', 'license-approved']) )
<?php
   $showCommentButton = auth()->user()->hasPermission('dlmc', 'comment');
   $showAutoCancelButton = auth()->user()->hasPermission('dlmc', 'auto-cancel');
   $showIncompleteButton = auth()->user()->hasPermission('dlmc', 'incomplete');

   $showInspectionButton = auth()->user()->hasPermission('dlmc', 'inspection-notice');
   
   if ($application->payment_status == 'initiated') {
      $showLocalPaymentButton = auth()->user()->hasPermission('dlmc', 'approve-payment');
   } else {
      $showLocalPaymentButton = false;
   }
   
   $showToRejectButton = auth()->user()->hasPermission('dlmc', 'to-reject');
   $showToApproveButton = auth()->user()->hasPermission('dlmc', 'to-approve');
   
   $showPreviewRejectionButton = auth()->user()->hasPermission('dlmc', 'preview-rejection') && $application->dlmcActionRecord->decision_status === 'rejectable';
   $showRejectButton = auth()->user()->hasPermission('dlmc', 'reject') && $application->dlmcActionRecord->decision_status === 'rejectable';

   
   $showApproveButton = auth()->user()->hasPermission('dlmc', 'approve') && $application->dlmcActionRecord->decision_status === 'approvable' && !is_null($application->dlmcActionRecord->temp_license_file_id);
   $showPreviewCertificateButton = auth()->user()->hasPermission('dlmc', 'preview-certificate') && $application->dlmcActionRecord->decision_status === 'approvable' && !is_null($application->dlmcActionRecord->temp_license_file_id);

   $showApproveTempLicenseButton = auth()->user()->hasPermission('dlmc', 'approve-temp-license') && $application->dlmcActionRecord->decision_status === 'approvable' && is_null($application->dlmcActionRecord->temp_license_file_id);
   

?>
 <x-officer-actions.buttons-wrapper
    :attrs="[
      'show-comment-button' => $showCommentButton,

      'show-inspection-button' => $showInspectionButton,
      'show-local-payment-button' => $showLocalPaymentButton,

      'show-to-approve-button' => $showToApproveButton,
      'show-preview-certificate-button' => $showPreviewCertificateButton,
      'show-approve-button' => $showApproveButton,
      'show-approve-temp-license-button' => $showApproveTempLicenseButton,

      'show-to-reject-button' => $showToRejectButton,
      'show-preview-rejection-button' => $showPreviewRejectionButton,
      'show-reject-button' => $showRejectButton,

      'show-auto-cancel-button' => $showAutoCancelButton,
      'show-incomplete-button' => $showIncompleteButton,
    ]">

 </x-officer-actions.buttons-wrapper>

 @endif
