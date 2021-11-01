<?php

namespace App\Model\Client;

use Illuminate\Database\Eloquent\Model;

use App\Model\GeneralSetup\{
    Township,
    District,
    Division
};

class ProductSupplyment extends Model
{
    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}