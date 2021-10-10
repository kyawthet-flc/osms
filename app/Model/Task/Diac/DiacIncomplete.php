<?php

namespace App\Model\Task\Diac;

use Illuminate\Database\Eloquent\Model;

class DiacIncomplete extends Model
{
    use \App\ApplicationLogTrait;
    
    protected $guarded = [];

    protected $data = [
        'incomplete_at'
    ];
}
