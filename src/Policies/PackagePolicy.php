<?php

namespace Adminetic\Website\Policies;

use App\Models\User;
use Adminetic\Website\Models\Admin\Package;
use Illuminate\Auth\Access\HandlesAuthorization;

class PackagePolicy
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
        return $user->userCanDo('Package', 'browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Package  $package
     * @return mixed
     */
    public function view(User $user, Package $package)
    {
        return $user->userCanDo('Package', 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userCanDo('Package', 'add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Package  $package
     * @return mixed
     */
    public function update(User $user, Package $package)
    {
        return $user->userCanDo('Package', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Package  $package
     * @return mixed
     */
    public function delete(User $user, Package $package)
    {
        return $user->userCanDo('Package', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Package  $package
     * @return mixed
     */
    public function restore(User $user, Package $package)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Package  $package
     * @return mixed
     */
    public function forceDelete(User $user, Package $package)
    {
        return true;
    }
}
