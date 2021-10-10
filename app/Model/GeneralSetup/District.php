<?php

namespace App\Model\GeneralSetup;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $guarded = [];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function townships()
    {
        return $this->hasMany(Township::class);
    }
}
