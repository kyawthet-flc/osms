<?php

namespace App\Model\Task\Onetime;

use Illuminate\Database\Eloquent\Model;

class OnetimeIncomplete extends Model
{
    use \App\ApplicationLogTrait;
    protected $guarded = [];
}
