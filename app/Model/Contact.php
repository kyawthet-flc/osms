<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Services\FileUploader;

class Contact extends Model
{    
    protected $guarded = [];

    public static function boot() {
        parent::boot();
        static::created(function($model) {

            if( request()->hasFile('contactFiles') ) {
                $files = (new FileUploader())->uploadMultiple(request()->file('contactFiles'), 'contact_files', false);
                $model->update(['file' => implode(',', $files) ]);
            }
        });
    }
}