<?php

namespace App\Model\Task\Diac;

use Illuminate\Database\Eloquent\Model;

class DiacDrugToImport extends Model
{
    protected $guarded = [];
    use \App\ApplicationLogTrait;

    public function scopeGenericName($q, $value)
    {
        if($value){
            return $q->where('generic_name', $value);
        }
        return $q;
    }

    public function scopeBrandName($q, $value)
    {
        if($value){
            return $q->where('brand_name', $value);
        }
        return $q;
    }
}
