<?php

namespace App\Policies;

use App\Models\Admin\Counter;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CounterPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }


    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->userCanDo('Counter', 'browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Counter  $counter
     * @return mixed
     */
    public function view(User $user, Counter $counter)
    {
        return $user->userCanDo('Counter', 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userCanDo('Counter', 'add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Counter  $counter
     * @return mixed
     */
    public function update(User $user, Counter $counter)
    {
        return $user->userCanDo('Counter', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Counter  $counter
     * @return mixed
     */
    public function delete(User $user, Counter $counter)
    {
        return $user->userCanDo('Counter', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Counter  $counter
     * @return mixed
     */
    public function restore(User $user, Counter $counter)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Counter  $counter
     * @return mixed
     */
    public function forceDelete(User $user, Counter $counter)
    {
        return true;
    }
}
