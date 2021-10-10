<?php

namespace App\Model\Task\Frontend;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $connection = 'mysql4';
    // protected $table = 'country_divisions';
    //

    public $timestamps = false;

    protected $guarded = [];

    public static function divisions()
    {
    	return self::get(['name', 'country_id', 'id'])->toArray();
    }

    public function districts(){
        return $this->hasMany(District::class);
    }
    
}
