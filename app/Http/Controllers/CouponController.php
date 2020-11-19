<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CouponController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     */
    public function apply(Request $request)
    {
        $total = array_sum(array_map(function ($item) {
            $type = $item['item_type'];

            return $type::find($item['item_id'])
                    ->getPrice() * $item['qty'];
        }, session('cart', [])));

        $coupon = Coupon::where('code', $request->code)->first();

        if (! $coupon) {
            throw ValidationException::withMessages([
                'code' => [
                    __('Invalid Coupon!'),
                ],
            ]);
        }

        if ($coupon->min_total > $total) {
            throw ValidationException::withMessages([
                'code' => [
                    __('Invalid Coupon!'),
                ],
            ]);
        }

        if ($coupon->usage_count <= Order::where('coupon_id', $coupon->id)->count()) {
            throw ValidationException::withMessages([
                'code' => [
                    __('Invalid Coupon!'),
                ],
            ]);
        }

        if ($coupon->usage_per_user <= Order::where('coupon_id', $coupon->id)->where(
                'user_id',
                auth()->id()
            )->count()) {
            throw ValidationException::withMessages([
                'code' => [
                    __('Invalid Coupon!'),
                ],
            ]);
        }

        $discount = $total * ((int) $coupon->value) / 100;

        session()->put('coupon', [
            'id' => $coupon->id,
            'discount' => $discount,
            'total' => $total - $discount,
        ]);

        return back();
    }
}
