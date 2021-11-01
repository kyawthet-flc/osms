<?php

namespace App\Model\Client;

use Illuminate\Database\Eloquent\Model;

use App\Model\GeneralSetup\{
    Township,
    District,
    Division
};

class Customer extends Model
{
    protected $guarded = [];

    public function township()
    {
        return $this->belongsTo(Township::class, 'ts_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'dis_id');
    }
    
    public function division()
    {
        return $this->belongsTo(Division::class, 'div_id');
    }

    public function getFullAddressAttribute()
    {
        // return "$this->address . '<br/>(' . $this->township->name . ' - '. $this->district->name .' - '.  $this->division->name . ')";
        return "{$this->township->name} - {$this->district->name} - {$this->division->name}";
    }

    // public function getCustomFullAddressAttribute()
    // {
    //     // return "$this->address . '<br/>(' . $this->township->name . ' - '. $this->district->name .' - '.  $this->division->name . ')";
    //     return "{$this->address} ({$this->township->name} - {$this->district->name} - {$this->division->name})";
    // }
    
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
