<?php

namespace App\View\Components\OfficerActions;

use Illuminate\View\Component;

class ButtonsWrapper extends Component
{
    public $showCommentButton = false;
    public $showAutoCancelButton = false;

    public $showIncompleteButton = false;
    public $showIncompleteTime = 0;
    public $showIncompleteDiabled = false;
    public $showIncompleteMsg = NULL;
    
    public $showToRejectButton = false;
    public $showPreviewRejectionButton = false;
    public $showRejectButton = false;
    
    public $showToApproveButton = false;
    public $showPreviewCertificateButton = false;
    public $showApproveButton = false;
    public $showPaymentButton = false;
    public $showLocalPaymentButton = false; 
    public $showInspectionButton = false;
    public $showApproveTempLicenseButton = false;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($attrs = array())
    {
        $this->showCommentButton = isset($attrs['show-comment-button'])? $attrs['show-comment-button']: false;
        $this->showAutoCancelButton = isset($attrs['show-auto-cancel-button'])? $attrs['show-auto-cancel-button']: false;

        $this->showIncompleteButton = isset($attrs['show-incomplete-button'])? $attrs['show-incomplete-button'] : false;
        $this->showIncompleteDiabled = isset($attrs['show-incomplete-diabled'])? $attrs['show-incomplete-diabled'] : false;
        $this->showIncompleteMsg = isset($attrs['show-incomplete-msg'])? $attrs['show-incomplete-msg'] : NULL;
        $this->showIncompleteTime = isset($attrs['show-incomplete-time'])? $attrs['show-incomplete-time'] : 0;

        $this->showToRejectButton = isset($attrs['show-to-reject-button'])? $attrs['show-to-reject-button'] : false;
        $this->showPreviewRejectionButton = isset($attrs['show-preview-rejection-button'])? $attrs['show-preview-rejection-button'] : false;
        $this->showRejectButton = $attrs['show-reject-button']?? false;

        $this->showToApproveButton = isset($attrs['show-to-approve-button'])? $attrs['show-to-approve-button']: false;
        $this->showPreviewCertificateButton = isset($attrs['show-preview-certificate-button'])? $attrs['show-preview-certificate-button']: false;
        $this->showApproveButton = isset($attrs['show-approve-button'])? $attrs['show-approve-button']:false;
        $this->showApproveTempLicenseButton = isset($attrs['show-approve-temp-license-button'])? $attrs['show-approve-temp-license-button']:false;
        $this->showPaymentButton = isset($attrs['show-payment-button'])? $attrs['show-payment-button']:false;
        $this->showLocalPaymentButton = isset($attrs['show-local-payment-button'])? $attrs['show-local-payment-button']:false;
        $this->showInspectionButton = isset($attrs['show-inspection-button'])? $attrs['show-inspection-button']:false;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.officer-actions.buttons-wrapper');
    }
}
