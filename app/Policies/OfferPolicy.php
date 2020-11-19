<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Offer;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any offers.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the offer.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Offer $offer
     * @return mixed
     */
    public function view(User $user, Offer $offer)
    {
        return false;
    }

    /**
     * Determine whether the user can create offers.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the offer.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Offer $offer
     * @return mixed
     */
    public function update(User $user, Offer $offer)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the offer.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Offer $offer
     * @return mixed
     */
    public function delete(User $user, Offer $offer)
    {
        return $user->isAdmin();
    }
}
