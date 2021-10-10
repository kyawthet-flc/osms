<?php

namespace App\Model\Task\Frontend;

use Illuminate\Database\Eloquent\Model;
use App\Model\Frontend\User;
use App\Model\Medical\MdeviceApplication;

class BusinessTypeCompany extends Model
{
    protected $connection = 'user';
    // protected $table = 'e_submission_user.business_type_companies';

   /* public function businessTypeCompany()
    {
        return $this->hasOne(MdeviceApplication::class, 'user_id', 'user_id');
    }*/

    public function country()
    {
        return $this->setConnection('mysql4')->hasOne(Country::class, 'id', 'country_id');
    }

    public function division()
    {
        return $this->setConnection('mysql4')->hasOne(Division::class, 'id', 'division_id');
    }

    public function district()
    {
        return $this->setConnection('mysql4')->hasOne(District::class, 'id', 'district_id');
    }
}
