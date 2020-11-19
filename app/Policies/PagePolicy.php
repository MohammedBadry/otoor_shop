<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Page;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any pages.
     *
     * @param \App\Models\User|null $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the page.
     *
     * @param \App\Models\User|null $user
     * @param \App\Models\Page $page
     * @return mixed
     */
    public function view(User $user, Page $page)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create pages.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the page.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Page $page
     * @return mixed
     */
    public function update(User $user, Page $page)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the page.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Page $page
     * @return mixed
     */
    public function delete(User $user, Page $page)
    {
        return $user->isAdmin();
    }
}
