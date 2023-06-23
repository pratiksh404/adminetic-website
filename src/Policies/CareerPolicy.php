<?php

namespace Adminetic\Website\Policies;

use Adminetic\Website\Models\Admin\Career;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CareerPolicy
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
        return $user->userCanDo('Career', 'browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Career  $career
     * @return mixed
     */
    public function view(User $user, Career $career)
    {
        return $user->userCanDo('Career', 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userCanDo('Career', 'add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Career  $career
     * @return mixed
     */
    public function update(User $user, Career $career)
    {
        return $user->userCanDo('Career', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Career  $career
     * @return mixed
     */
    public function delete(User $user, Career $career)
    {
        return $user->userCanDo('Career', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Career  $career
     * @return mixed
     */
    public function restore(User $user, Career $career)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Career  $career
     * @return mixed
     */
    public function forceDelete(User $user, Career $career)
    {
        return true;
    }
}
