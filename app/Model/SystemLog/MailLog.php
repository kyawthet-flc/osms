<?php

namespace App\Model\SystemLog;

use Illuminate\Database\Eloquent\Model;
use App\User as AdminUser;
use App\Model\Task\Frontend\User as ApplicantUser;

class MailLog extends Model
{
    protected $guarded = [];

    public function scopeFilters($q)
    {
        if (request('from_email')) $q->where('from_email', 'LIKE', "%" .request('from_email')."%");
        if (request('to_email')) $q->where('to_email', 'LIKE', "%" .request('to_email')."%");
        if (request('subject')) $q->where('subject', 'LIKE', "%" .request('subject')."%");

        if(request('sent_at')){
            $date = date_range(request('sent_at'));
            return $q->whereBetween('created_at', $date);
        }

        return $q;
    }

}