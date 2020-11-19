<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CurrencyExchangeRate;
use Illuminate\Auth\Access\HandlesAuthorization;

class CurrencyExchangeRatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin()
            && CurrencyExchangeRate::whereDate('day', today())->doesntExist();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\CurrencyExchangeRate $currencyExchangeRate
     * @return mixed
     */
    public function update(User $user, CurrencyExchangeRate $currencyExchangeRate)
    {
        return $user->isAdmin();
    }
}
