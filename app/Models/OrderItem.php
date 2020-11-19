<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'qty',
        'price',
        'order_id',
        'size_id',
        'item_id',
        'item_type',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function item()
    {
        return $this->morphTo('item');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function (OrderItem $item) {
            if ($item->item) {
                $item->forceFill(['price' => $item->item->getPrice()]);
            }
        });
        static::saved(function (OrderItem $item) {
            if ($item->order) {

                $item->order->forceFill(['total' => $item->order->items()->sum('total')])->save();
            }
        });
    }
}
