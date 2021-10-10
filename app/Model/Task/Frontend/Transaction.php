<?php

namespace App\Model\Task\Frontend;

use Illuminate\Database\Eloquent\Model;

use App\Model\Medical\MdeviceApplicationHistory;
use App\Helpers\Util;

class Transaction extends Model
{
    protected $connection = 'user';
    // protected $table = 'e_submission_user.transactions';
    // protected $table = 'fda_e_submission_user_db.transactions';
    
    protected $guarded = [];

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
        $this->table = env('DB_DATABASE_3').".transactions";
    }

    public function scopePaymentDate($q, $value)
    {
        if($value){
            $date = Util::getDateRange($value);
            return $q->whereBetween('created_at', $date);
        }
        return $q;
    }

    public function getShowGuidAttribute()
    {
        return str_pad($this->guid, 8, '0', STR_PAD_LEFT);
    }

    public function ft()
    {
        return $this->setConnection('mysql')->hasOne(MdeviceApplicationHistory::class, 'transaction_id', 'id');
    }

    public function st()
    {
        return $this->setConnection('mysql')->hasOne(MdeviceApplicationHistory::class, 'second_transaction_id', 'id');
    }

    /*

    public function mdeviceProductLabTransaction()
    {
        return $this->hasOne(Product::class, 'lab_transaction_id', 'id');
    }

    public function mdeviceProductTransaction()
    {
        return $this->hasOne(ProductHistory::class, 'transaction_id', 'id');
    }

    public function mdeviceLabTransaction()
    {
        return $this->hasOne(MdeviceApplication::class, 'lab_transaction_id', 'id');
    }

    public function mdeviceAppHistoryTransaction()
    {
        return $this->hasOne(MDeviceAppHistory::class, 'transaction_id', 'id');
    }

    public function mdeviceAppHistorySecondTransaction()
    {
        return $this->hasOne(MDeviceAppHistory::class, 'second_transaction_id', 'id');
    }

    public function oneTimeTransaction()
    {
        return $this->hasOne(OneTimeHistory::class, 'transaction_id', 'id');
    }

    public function amendCompanyOwnerTransaction()
    {
        return $this->hasOne(AmendCompanyOwner::class, 'transaction_id', 'id');
    }

    public function cosmeticHistoryTransaction()
    {
        return $this->hasOne(CosApplicationHistory::class, 'transaction_id', 'id');
    }

    public function cosmeticlocalHistoryTransaction()
    {
        return $this->hasOne(LocalApplicationHistory::class, 'transaction_id', 'id');
    }*/

}
