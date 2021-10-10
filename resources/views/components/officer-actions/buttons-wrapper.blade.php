<div class="row">
  <div class="col-md-12 mt-1 mb-3 text-right">

    @if( $showCommentButton )
      <button class="btn btn-primary officer-action-btn" action-name="comment-block">Comment</button>
    @endif

    @if( $showPaymentButton )
      <button class="btn btn btn-warning officer-action-btn" action-name="payment-block">Pay Registration Fee</button>
    @endif

    @if( $showLocalPaymentButton )
      <button class="btn btn btn-warning officer-action-btn" action-name="local-payment-block">Pay Registration Fee</button>
    @endif

    @if( $showInspectionButton )
      <button class="btn btn btn-success officer-action-btn" action-name="inspection-block">Inspection Notice</button>
    @endif

    @if( $showAutoCancelButton )
      <button class="btn btn-info officer-action-btn" action-name="auto-cancel-block">Auto Cancel</button>
    @endif

    @if($showIncompleteButton)
       @if( $showIncompleteDiabled )
        <button class="btn btn-warning" disabled="disabled" action-name="incomplete-block">
          Incomplete <span>(Already {{ $showIncompleteTime }} time(s))</span>
        </button>
       @else
        <button class="btn btn-warning officer-action-btn" action-name="incomplete-block">Incomplete</button>
       @endif
    @endif

    @if( $showToRejectButton )
      <button class="btn btn-danger no-alert officer-action-btn" action-name="to-reject-block">To Reject</button>
    @endif

    @if( $showPreviewRejectionButton )
      <button class="btn btn-danger no-alert officer-action-btn" action-name="preview-rejection-block">Preview Rejection</button>
    @endif

    @if( $showRejectButton )
      <button class="btn btn-danger no-alert officer-action-btn" action-name="reject-block">Reject</button>
    @endif

    @if( $showToApproveButton )
       <button class="btn btn-success officer-action-btn" action-name="to-approve-block">To Approve</button>
    @endif

    @if( $showPreviewCertificateButton )
      <button class="btn btn btn-info officer-action-btn" action-name="preview-certificate-block">Preview Certificate</button>
    @endif

    @if( $showApproveButton )
      <button class="btn btn-success officer-action-btn" action-name="approve-block">Approve</button>
    @endif
    
    @if( $showApproveTempLicenseButton )
      <button class="btn btn-success officer-action-btn" action-name="approve-license-block">Approve Temporary License</button>
    @endif
</div>
</div>
