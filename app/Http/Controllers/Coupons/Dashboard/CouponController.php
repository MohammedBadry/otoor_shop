<?php

namespace App\Http\Controllers\Coupons\Dashboard;

use App\Models\Coupon;
use Illuminate\Routing\Controller;
use App\Http\Requests\Coupons\CouponRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CouponController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * CouponController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Coupon::class, 'coupon');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::filter()->paginate();

        return view('dashboard.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Coupons\CouponRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CouponRequest $request)
    {
        $coupon = Coupon::create($request->all());

        flash(trans('coupons.messages.created'));

        return redirect()->route('dashboard.coupons.show', $coupon);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        return view('dashboard.coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('dashboard.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Coupons\CouponRequest $request
     * @param \App\Models\Coupon $coupon
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        $coupon->update($request->all());

        flash(trans('coupons.messages.updated'));

        return redirect()->route('dashboard.coupons.show', $coupon);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Coupon $coupon
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        flash(trans('coupons.messages.deleted'));

        return redirect()->route('dashboard.coupons.index');
    }
}
