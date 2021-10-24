<?php

namespace App\Model\Client;

use Illuminate\Database\Eloquent\Model;

use App\Services\FileUploader;

class SubProduct extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
        	$model->createSubSkuCode();
            $model->handleSubProductImages();
            $model->updateParentProductTotalSubProduct();
        });

        static::updated(function ($model) {
            $model->updateParentProductTotalSubProduct();
        });

        static::deleted(function ($model) {
            $model->updateParentProductTotalSubProduct();
        });

    }

    // update total item count in product table
    public function updateParentProductTotalSubProduct()
    {
        $this->product->update(['total_sub_product' => $this->product->subProducts()->sum('quantity_avaiable') ]);
    }

    public function handleSubProductImages()
    {
        if( request()->hasFile('files') ) {
            $files = (new FileUploader())->uploadMultiple(request()->file('files'), 'product_images', false);
            foreach ($files as $fileId) {
                $this->subProductImages()->create(['file_id' => $fileId]);
            }
        }
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function subProductImages()
    {
        return $this->hasMany(SubProductImage::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function createSubSkuCode()
    {
        if ( is_null($this->sub_sku) ) {

            $lastApp = $this->where('id', '<>', $this->id)->whereProductId($this->product->id)->orderBy('sub_sku', 'desc')->first();
            $skuSerial = "001";
            if ( isset($lastApp) && $lastApp->sub_sku ) {
                $skuSerial = $lastApp->sub_sku + 1;
                $skuSerial = str_pad($skuSerial, 3, "0", STR_PAD_LEFT); 
            }

            $this->update(['sub_sku' => $skuSerial]);
        }
    }
}
