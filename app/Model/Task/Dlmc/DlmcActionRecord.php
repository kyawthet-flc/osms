<?php

namespace App\Model\Task\Dlmc;

use Illuminate\Database\Eloquent\Model;
use App\Model\Task\Dlmc\DlmcActionRecordFilterTrait;
class DlmcActionRecord extends Model
{
    use DlmcActionRecordFilterTrait;
    use \App\ApplicationLogTrait;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(\App\User::class, 'id', 'assigned_officer_id');
    }
}
