<?php

namespace App\Model\ProductSetup;

use Illuminate\Database\Eloquent\Model;

use App\Model\Client\Product;

class ProductAttr extends Model
{
    protected $guarded = [];

    public function image()
    {
        return $this->hasOne(\App\Model\File::class, 'id', 'additional');
    }

    public static function createColorCode(Product $product)
    {
        $shortCode = substr(remove_space($product->name), 0, 4);
        $existingCount = self::whereEntityName('products')->whereEntityId($product->id)->whereAttribute('color')->count();
        $serial = $existingCount > 0? $existingCount + 1: 1;
        return strtoupper(strtolower($shortCode)) . '-' . str_pad($serial, 4, "0", STR_PAD_LEFT);
        
    }

}