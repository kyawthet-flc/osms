<?php

namespace App\Model\Task\Dlmc;

trait DlmcActionRecordFilterTrait
{
    public function scopePaidAt($q, $value)
    {
        if($value && date_range($value) ){
            return $q->whereBetween('paid_at', date_range($value));
        }
        return $q;
    }

    public function scopeSubmittedAt($q, $value)
    {
        if($value && date_range($value) ){
            return $q->whereBetween('submitted_at', date_range($value));
        }
        return $q;
    }

    public function scopeResubmittedAt($q, $value)
    {
        if($value && date_range($value) ){
            return $q->whereBetween('resubmitted_at', date_range($value));
        }
        return $q;
    }

    public function scopeIncompleteAt($q, $value)
    {
        if($value && date_range($value) ){
            return $q->whereBetween('incomplete_at', date_range($value));
        }
        return $q;
    }

    public function scopeAutoCancelledAt($q, $value)
    {
        if($value && date_range($value)){
            return $q->whereBetween('autocancelled_at', date_range($value));
        }
        return $q;
    }

    public function scopeRejectedAt($q, $value)
    {
        if($value && date_range($value) ){
            return $q->whereBetween('rejected_at', date_range($value));
        }
        return $q;
    }

    public function scopeApprovedAt($q, $value)
    {
        if($value && date_range($value) ){
            return $q->whereBetween('approved_at', date_range($value));
        }
        return $q;
    }

    public function scopeTempLicenseAt($q, $value)
    {
        if($value && date_range($value) ){
            return $q->whereBetween('temp_license_at', date_range($value));
        }
        return $q;
    }
}
