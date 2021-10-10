<?php

namespace App\Model\Task\DrcLocal;

use Illuminate\Database\Eloquent\Model;

class DrcLocalActionRecord extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(\App\User::class, 'id', 'assigned_officer_id');
    }
}
