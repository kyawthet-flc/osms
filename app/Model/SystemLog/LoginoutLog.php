<?php

namespace App\Model\SystemLog;

use Illuminate\Database\Eloquent\Model;
use App\User;

class LoginoutLog extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
    