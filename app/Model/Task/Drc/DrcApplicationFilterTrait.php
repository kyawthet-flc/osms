<?php
namespace App\Model\Task\Drc;

trait DrcApplicationFilterTrait {

    public function scopeApplicationNo($q, $value)
    {
        if( $value ) {
            return $q->where('application_no', $value);
        }
    }

    public function scopeGenericName($q, $value)
    {
        if( $value ) {
            return $q->where('generic_name', $value);
        }
    }
    public function scopeDosageForm($q, $value)
    {
        if( $value ) {
            return $q->where('dosage_form', $value);
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

    public function scopeRegistrationFee($q, $value)
    {
        if( $value && $value != 'reg_fee_all' ){
            return $q->where('registration_fee', $value);
        }
        return $q;
    }
}
