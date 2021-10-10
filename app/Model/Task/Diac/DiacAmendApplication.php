<?php

namespace App\Model\Task\Diac;

use Illuminate\Database\Eloquent\Model;

class DiacAmendApplication extends Model
{
    
    protected $guarded = [];

    protected $perPage = 10;

    public function diacApplication()
    {
        return $this->belongsTo(DiacApplication::class);
    }

}