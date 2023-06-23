<?php

namespace Adminetic\Website\Policies;

use Adminetic\Website\Models\Admin\Feature;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeaturePolicy
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
        return $user->userCanDo('Feature', 'browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Feature  $feature
     * @return mixed
     */
    public function view(User $user, Feature $feature)
    {
        return $user->userCanDo('Feature', 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userCanDo('Feature', 'add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Feature  $feature
     * @return mixed
     */
    public function update(User $user, Feature $feature)
    {
        return $user->userCanDo('Feature', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Feature  $feature
     * @return mixed
     */
    public function delete(User $user, Feature $feature)
    {
        return $user->userCanDo('Feature', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Feature  $feature
     * @return mixed
     */
    public function restore(User $user, Feature $feature)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Feature  $feature
     * @return mixed
     */
    public function forceDelete(User $user, Feature $feature)
    {
        return true;
    }
}
