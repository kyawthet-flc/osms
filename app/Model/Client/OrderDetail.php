<?php

namespace App\Model\Client;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
        	$model->toggleOrderRelation($model->quantity);
            $model->updateOrderTotalPrice();
        });
        
        static::updated(function ($model) {
            $model->toggleOrderRelation();
            $model->updateOrderTotalPrice();
        });

        static::deleting(function ($model) {
            $subProduct = SubProduct::whereId($model->sub_product_id)->first();
            $subProduct->update(['quantity_left' => ($subProduct->quantity_left + $model->quantity)]);
            $model->order->update([
                'total_amount' => $model->order->total_amount - $model->sub_total_price,
                'total_discount' => $model->order->total_discount - $model->total_discount
            ]);
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function subProduct()
    {
        return $this->belongsTo(SubProduct::class);
    }

    // update to parent order table
    // update to sub  product table
    // update tp product table
    public function toggleOrderRelation($qty=0)
    {
        $subProduct = SubProduct::whereId($this->sub_product_id)->first();

        if ( $qty === 0 ) {
            if ( $this->getOriginal('quantity') > $this->quantity ) {
                $qtyLeft = $this->getOriginal('quantity') - $this->quantity;
            } else if ( $this->getOriginal('quantity') < $this->quantity ) {
                $qtyLeft = $this->quantity - $this->getOriginal('quantity');
            } else {
                $qtyLeft = $this->quantity;
            }
            $qtyLeft = $subProduct->quantity_left - $qtyLeft;
        } else {
            $qtyLeft = $subProduct->quantity_left - $qty;
        }
        $subProduct->update(['quantity_left' => $qtyLeft]);
    }

    public function updateOrderTotalPrice()
    {
        $this->order->update([
            'total_amount' => $this->order->orderDetails()->sum('sub_total_price'),
            'total_discount' => $this->order->orderDetails()->sum('sub_total_discount')
        ]);
    }
}
