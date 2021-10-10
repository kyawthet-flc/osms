<?php

namespace App\Model\Client;

use Illuminate\Database\Eloquent\Model;

class SubProduct extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
        	$model->createSubSkuCode();
        });
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function createSubSkuCode()
    {
        if ( is_null($this->sub_sku) ) {

            $lastApp = $this->where('id', '<>', $this->id)->orderBy('sku_serial', 'desc')->first();
            $subSkuSerial = 1;
            if ( isset($lastApp) && $lastApp->sub_sku ) {
                $skuSerial = $lastApp->sub_sku + 1;
                $skuSerial = str_pad($skuSerial, 3, "0", STR_PAD_LEFT); 
            }

            $this->update(['sub_sku' => $subSkuSerial]);
        }
    }
}
