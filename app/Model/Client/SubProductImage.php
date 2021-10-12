<?php

namespace App\Model\Client;

use Illuminate\Database\Eloquent\Model;
use App\Model\File;

class SubProductImage extends Model
{
    protected $guarded = [];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($model) {
    //     	$model->createSubSkuCode();
    //     });
    // }
    public function image()
    {
        return $this->hasOne(File::class, 'id', 'file_id');
    }
}
