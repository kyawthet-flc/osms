<?php

namespace App;
use App\Model\SystemLog\ApplicationLog;

trait ApplicationLogTrait
{
    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
        	(new ApplicationLog)->createLog($model, 'created');
        });

        static::updated(function ($model) {
        	(new ApplicationLog)->createLog($model, 'updated');
        });

        static::deleted(function ($model) {
        	(new ApplicationLog)->createLog($model, 'deleted');
        });

    }

}
