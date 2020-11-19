<?php

namespace App\Http\Controllers\Coupons\Api;

use App\Models\Coupon;
use Illuminate\Routing\Controller;
use App\Http\Resources\Coupons\CouponResource;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CouponController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the coupons.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $coupons = Coupon::filter()->paginate();

        return CouponResource::collection($coupons);
    }

    /**
     * Display the specified coupon.
     *
     * @param \App\Models\Coupon $coupon
     * @return \App\Http\Resources\Coupons\CouponResource
     */
    public function show(Coupon $coupon)
    {
        return new CouponResource($coupon);
    }
}
