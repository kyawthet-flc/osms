<?php

namespace App\Model\Task\DrcLocal;

use Illuminate\Database\Eloquent\Model;

class DrcLocalApplication extends Model
{
    protected $guarded = [];

    protected $perPage = 10;

    public function dlmcActionRecord()
    {
        return $this->hasOne(DlmcActionRecord::class);
    }
}
