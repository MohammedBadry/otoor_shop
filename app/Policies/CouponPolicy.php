<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Coupon;
use Illuminate\Auth\Access\HandlesAuthorization;

class CouponPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any coupons.
     *
     * @param \App\Models\User|null $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the coupon.
     *
     * @param \App\Models\User|null $user
     * @param \App\Models\Coupon $coupon
     * @return mixed
     */
    public function view(User $user, Coupon $coupon)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create coupons.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the coupon.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Coupon $coupon
     * @return mixed
     */
    public function update(User $user, Coupon $coupon)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the coupon.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Coupon $coupon
     * @return mixed
     */
    public function delete(User $user, Coupon $coupon)
    {
        return $user->isAdmin();
    }
}
