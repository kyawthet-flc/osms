<?php
namespace App\Model\Task\Frontend;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $connection = 'mysql4';
    
    protected $guarded = [];

    public static function countries()
    {
    	return self::pluck('name', 'id')->toArray();
    }

    public static function myanmarOnly()
    {
    	return self::whereId(148)->get(['name', 'id'])->toArray();
    }

    public function divisions()
    {
        return $this->hasMany(Division::class);
    }

}
