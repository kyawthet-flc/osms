<?php

namespace App\Model\Task\Frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $connection = 'user';

    const business_type = [
        'Company' => 'Company',
        'Other' => 'Other'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getShowNameAttribute(){
        return $this->name.' ('.$this->email.')';
    }

    public function businessTypeCompany()
    {
        return $this->hasOne(BusinessTypeCompany::class, 'user_id', 'id');
    }

    public function businessTypeOther()
    {
        return $this->hasOne(BusinessTypeOther::class, 'user_id', 'id');
    }

    public function isBusinessCompany()
    {
        return strtolower($this->business_type) === 'company';
    }

    public function isBusinessOther()
    {
        return strtolower($this->business_type) === 'other';
    }

    public function businessCompanyAddress()
    {
        if ( is_null($this->businessTypeCompany) ) {
            return '';
        }

        return optional($this->businessTypeCompany)->no_unit_level .", ". 
               optional($this->businessTypeCompany)->street .", ". 
               optional($this->businessTypeCompany)->city_township .", ".
               optional($this->businessTypeCompany->district)->name .", ".
               optional($this->businessTypeCompany->division)->name .", ".
               optional($this->businessTypeCompany->country)->name;
    }

    public function otherCompanyAddress()
    {
        if ( is_null($this->businessTypeOther) ) {
            return '';
        }

        return optional($this->businessTypeOther)->no_unit_level .", ". 
               optional($this->businessTypeOther)->street .", ". 
               optional($this->businessTypeOther)->city_township .", ".
               optional($this->businessTypeOther->district)->name .", ".
               optional($this->businessTypeOther->division)->name .", ".
               optional($this->businessTypeOther->country)->name;
    }
}
