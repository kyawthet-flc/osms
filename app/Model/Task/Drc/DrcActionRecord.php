<?php

namespace App\Model\Task\Drc;

use Illuminate\Database\Eloquent\Model;

class DrcActionRecord extends Model
{
    use \App\ApplicationLogTrait;

    use DrcActionRecordFilterTrait;
    protected $guarded = [];

    protected $dates = [
        'submitted_at',
        'lab_requested_at',
        'lab_checked_at',
        'lab_rechecked_at',
        'lab_received_at',
        'lab_resulted_at'
    ];

    public function user()
    {
        return $this->hasOne(\App\User::class, 'id', 'assigned_officer_id');
    }

    public function drcApplication()
    {
        return $this->belongsTo(DrcApplication::class);
    }
}
