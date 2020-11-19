<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Size;
use Illuminate\Auth\Access\HandlesAuthorization;

class SizePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any sizes.
     *
     * @param \App\Models\User|null $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the size.
     *
     * @param \App\Models\User|null $user
     * @param \App\Models\Size $size
     * @return mixed
     */
    public function view(User $user, Size $size)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create sizes.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the size.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Size $size
     * @return mixed
     */
    public function update(User $user, Size $size)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the size.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Size $size
     * @return mixed
     */
    public function delete(User $user, Size $size)
    {
        return $user->isAdmin();
    }
}
