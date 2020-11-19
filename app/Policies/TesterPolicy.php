<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tester;
use Illuminate\Auth\Access\HandlesAuthorization;

class TesterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any testers.
     *
     * @param \App\Models\User|null $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false; //$user->isAdmin();
    }

    /**
     * Determine whether the user can view the tester.
     *
     * @param \App\Models\User|null $user
     * @param \App\Models\Tester $tester
     * @return mixed
     */
    public function view(User $user, Tester $tester)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create testers.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the tester.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Tester $tester
     * @return mixed
     */
    public function update(User $user, Tester $tester)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the tester.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Tester $tester
     * @return mixed
     */
    public function delete(User $user, Tester $tester)
    {
        return $user->isAdmin();
    }
}
