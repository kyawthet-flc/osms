<?php

namespace App\Model\Task\Drc;

use Illuminate\Database\Eloquent\Model;

class DrcApplicant extends Model
{
    use \App\ApplicationLogTrait;
    
    protected $guarded = [];
}
