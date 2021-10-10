<?php

namespace App\Model\Task;

use Illuminate\Database\Eloquent\Model;

class DdgDecisionHistory extends Model
{
    protected $guarded = [];

    public function scopeCreatedAt($q, $value)
    {
        if($value ){
            return $q->whereDate('created_at', $value);
        }
        return $q;
    }

}
