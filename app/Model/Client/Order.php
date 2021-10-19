<?php

namespace App\Model\Client;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    protected $dates = [
        "ordered_at",
        "delivered_at",
        "received_at",
        "paid_at"
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
        	$model->createCode();
        });

        static::deleting(function ($model) {
        	foreach ($model->orderDetails as $key => $orderDetail) {
                $orderDetail->delete();
            }
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function createCode()
    {
        if ( is_null($this->code) && is_null($this->code_serial)  ) {

            $lastApp = $this->where('id', '<>', $this->id)->orderBy('code_serial', 'desc')->first();
            $codeSerial = '000000001';
            $sku = 'ODR';
            if ( isset($lastApp) && $lastApp->code_serial ) {
                $codeSerial = $lastApp->code_serial + 1;
                $codeSerial = str_pad($codeSerial, 9, "0", STR_PAD_LEFT); 
            }

            $this->update(['code' => $sku.'-'.$codeSerial, 'code_serial' => $codeSerial ]);
        }
    }

}
