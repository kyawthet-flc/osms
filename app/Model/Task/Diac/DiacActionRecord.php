<?php

namespace App\Model\Task\Diac;

use Illuminate\Database\Eloquent\Model;
use App\Model\Task\Diac\DiacActionRecordFilterTrait;

class DiacActionRecord extends Model
{
    use DiacActionRecordFilterTrait;
    use \App\ApplicationLogTrait;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(\App\User::class, 'id', 'assigned_officer_id');
    }

}
