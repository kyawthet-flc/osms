<?php

namespace App\Model\Task\Frontend;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $connection = 'mysql4';

    // protected $table = 'district';
    //

    protected $guarded = [];

    public static function districts()
    {
    	return self::get(['name', 'division_id', 'id'])->toArray();
    }

}
