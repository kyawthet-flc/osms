<?php

namespace App\View\Components\OfficerActions;

trait ActionTraits {

    public $onlyLink = false;
    public $officers;
    public $toOfficerId;
    public $subject;
    public $body;
    public $amount;

    public $isSubjectMandatory;
    public $isBodyMandatory;

    public $hasAdditionalBox;

    public $actionUrl;
    public $application;

    public function _init($attrs = array())
    {
        $this->toOfficerId = $attrs['to_officer_id']?? null;
        $this->officers = $attrs['officers']?? [];
        
        $this->subject = $attrs['subject']?? '';
        $this->amount = $attrs['amount']?? '';
        $this->body = $attrs['body']?? '';

        $this->isSubjectMandatory = $attrs['is_subject_mandatory']?? false;
        $this->isBodyMandatory = $attrs['is_body_mandatory']?? false;

        $this->hasAdditionalBox = $attrs['has_additional_box']?? false;

        $this->actionUrl = $attrs['actionUrl']?? false;
        $this->application = $attrs['application']?? NULL;
    }

}