<?php

namespace App\Model\Client;

use Illuminate\Database\Eloquent\Model;

use App\Model\ProductSetup\{ProductType, ProductAttr};

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

    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }

    // public function orders()
    // {
    //     return $this->hasMany(Order::class, 'og', 'order_id');
    // }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function productSupplyments()
    {
        return $this->hasMany(ProductSupplyment::class);
    }

    public function productAttrs()
    {
        return $this->hasMany(ProductAttr::class, 'entity_id', 'id')->whereEntityName('products');
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
