<?php

namespace App\Model\ProductSetup;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $guarded = [];

    public function productAttributes()
    {
        $this->hasMany(ProductAttr::class, 'entity_id', 'id')->whereEntityName('product_type');
    }

}