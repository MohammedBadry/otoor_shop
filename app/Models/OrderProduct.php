<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'qty',
        'price',
        'order_id',
        'product_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function (OrderProduct $item) {
            if ($item->product) {
                $item->forceFill(['price' => $item->product->getPrice()]);
            }
        });
        static::saved(function (OrderProduct $item) {
            if ($item->order) {

                $item->order->forceFill(['total' => $item->order->orderProducts()->sum('total')])->save();
            }
        });
    }
}
