<?php

namespace App\Model\Client;

use Illuminate\Database\Eloquent\Model;

use App\Model\ProductSetup\ProductType;

class Product extends Model
{
    protected $guarded = [];

    protected $date = ['selling_at'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
        	$model->createSkuCode();
            // if ( is_null($model->selling_at) && 'on_sale' === $model->status ) {
            //     $model->update(['selling_at' => now() ]);
            // }
        });
        
        static::updating(function ($model) {
        	// if ( is_null($model->selling_at) && 'on_sale' === $model->status ) {
            //     $model->update(['selling_at' => now() ]);
            // }
        });
    }
    
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function subProducts()
    {
        return $this->hasMany(SubProduct::class);
    }

    public function createSkuCode()
    {
        if ( is_null($this->sku) && is_null($this->sku_serial)  ) {

            $lastApp = $this->where('id', '<>', $this->id)->orderBy('sku_serial', 'desc')->first();
            $skuSerial = '00000001';
            $sku = 'OSMS';
            if ( isset($lastApp) && $lastApp->sku_serial ) {
                $skuSerial = $lastApp->sku_serial + 1;
                $skuSerial = str_pad($skuSerial, 8, "0", STR_PAD_LEFT); 
            }

            $this->update(['sku' => $sku . '-' . $skuSerial, 'sku_serial' => $skuSerial]);
        }
    }
}
