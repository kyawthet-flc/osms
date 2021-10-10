<?php

namespace App\Model\Task\Onetime;

use Illuminate\Database\Eloquent\Model;
use App\Model\Task\Frontend\Transaction;
use App\Model\Task\Onetime\OnetimeActionRecordFilterTrait;

class OnetimeActionRecord extends Model
{
    use OnetimeActionRecordFilterTrait;
    use \App\ApplicationLogTrait;
    protected $guarded = [];
    
    public function user()
    {
        return $this->hasOne(\App\User::class, 'id', 'assigned_officer_id');
    }
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
