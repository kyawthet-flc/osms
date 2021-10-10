<?php

namespace App\Model\Task\Onetime;

use Illuminate\Database\Eloquent\Model;

class OnetimePaymentRecord extends Model
{
    use \App\ApplicationLogTrait;
    
    protected $guarded = [];  
}
