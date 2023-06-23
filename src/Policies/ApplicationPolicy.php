<?php

namespace Adminetic\Website\Policies;

use Adminetic\Website\Models\Admin\Application;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationPolicy
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
        return $user->userCanDo('Application', 'browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Application  $application
     * @return mixed
     */
    public function view(User $user, Application $application)
    {
        return $user->userCanDo('Application', 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userCanDo('Application', 'add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Application  $application
     * @return mixed
     */
    public function update(User $user, Application $application)
    {
        return $user->userCanDo('Application', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Application  $application
     * @return mixed
     */
    public function delete(User $user, Application $application)
    {
        return $user->userCanDo('Application', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Application  $application
     * @return mixed
     */
    public function restore(User $user, Application $application)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Application  $application
     * @return mixed
     */
    public function forceDelete(User $user, Application $application)
    {
        return true;
    }
}
