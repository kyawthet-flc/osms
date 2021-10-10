<?php

namespace App\Model\Task\Onetime;

trait OnetimeApplicationFilterTrait
{
    public function scopefilters($q, $value)
    {
        if( $value ) {
            return $q->where('application_no', $value);
        }
    }

   

    public function scopeApplicationNo($q, $value)
    {
        if( $value ) {
            return $q->where('application_no', $value);
        }
    }

    public function scopeCertificateNo($q, $value)
    {
        if( $value ) {
            return $q->where('certificate_no', $value);
        }
    }

    public function scopeApplicationStatus($q, $value)
    {
        if( $value ) {
            return $q->where('application_status', $value);
        }
    }

    public function scopeApplicationType($q, $value)
    {
        if( $value ) {
            return $q->where('application_Type', $value);
        }
    }

    public function scopeIssuedAt($q, $value)
    {
        if($value && date_range($value) ){
            return $q->whereBetween('issue_date', date_range($value));
        }
        return $q;
    }

    public function scopeExpiredAt($q, $value)
    {
        if($value && date_range($value) ){
            return $q->whereBetween('expire_date', date_range($value));
        }
        return $q;
    }

}
