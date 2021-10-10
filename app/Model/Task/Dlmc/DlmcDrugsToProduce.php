<?php

namespace App\Model\Task\Dlmc;

use Illuminate\Database\Eloquent\Model;

class DlmcDrugsToProduce extends Model
{
    protected $guarded = [];

    /**
    * Filter by dosage_type.
    */
    public function scopeDosageType($q, $value)
    {
        if($value){
            $q->where('dosage_type', 'like', "%{$value}%");
        }

        return $q;
    }
    
}
