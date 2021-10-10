<?php

namespace App\Model\Task\Frontend;

use Illuminate\Database\Eloquent\Model;

class CBPay extends Model
{
    protected $table = 'cbpay';

    protected $fillable = [
        'msg',
        'transaction_id',
        'transStatus',
        'bankTransId',
        'transAmount',
        'transCurrency',
    ];
}
