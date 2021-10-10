<?php

namespace App\Model\GeneralSetup;

use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    protected $guarded = [];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function shop()
    {
        return $this->hasOne(\App\Model\Client\Shop::class, 'ts_id');
    }

    public function compiledTsDisDiv()
    {
        $townshipArr = array();
        $townships = Township::with(['district', 'division'])->get();
        
        foreach ($townships as $key => $township) {
            array_push($townshipArr, [
                'key' => $township->id, 
                'value' => '<b>' . $township->name . ' Township</b>(<i>' . optional($township->district)->name . ' - ' . optional($township->division)->name . '</i>)'
            ]);
        }
        // dd($townshipArr);
        return $townshipArr;
    }

}
