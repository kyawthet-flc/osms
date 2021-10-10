<?php

namespace App\Model\Task\Drc;

use Illuminate\Database\Eloquent\Model;

class DrcIncomplete extends Model
{
    use \App\ApplicationLogTrait;
    
    protected $guarded = [];
}
