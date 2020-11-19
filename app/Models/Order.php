<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use App\Http\Filters\Orders\OrderFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use Filterable;

    const PENDING = 'pending';

    const IN_PROGRESS = 'in-progress';

    const CANCELED = 'canceled';

    const REJECTED = 'rejected';

    const DELIVERED = 'delivered';

    protected $fillable = [
        'user_id',
        'coupon_id',
        'city',
        'name',
        'phone',
        'area',
        'street',
        'address',
        'gift_message',
        'payment_method',
    ];


    /**
     * The query parameter's filter of the model.
     *
     * @var string
     */
    protected $filter = OrderFilter::class;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Order $order) {
            $order->forceFill(['status' => Order::PENDING]);
        });
    }
}
