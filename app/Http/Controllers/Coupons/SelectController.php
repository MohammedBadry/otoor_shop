<?php

namespace App\Http\Controllers\Coupons;

use App\Models\Coupon;
use Illuminate\Routing\Controller;
use App\Http\Filters\Coupons\SelectFilter;
use App\Http\Resources\Coupons\SelectResource;

class SelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Filters\Coupons\SelectFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(SelectFilter $filter)
    {
        $coupons = Coupon::filter($filter)->paginate();

        return SelectResource::collection($coupons);
    }
}
