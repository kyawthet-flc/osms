<?php

namespace App\Model\GeneralSetup;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = [];

    public function divisions()
    {
        return $this->hasMany(Division::class);
    }
}
