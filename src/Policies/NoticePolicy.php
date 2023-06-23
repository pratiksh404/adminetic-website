<?php

namespace Adminetic\Website\Policies;

use Adminetic\Website\Models\Admin\Notice;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NoticePolicy
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
        return $user->userCanDo('Notice', 'browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Notice  $notice
     * @return mixed
     */
    public function view(User $user, Notice $notice)
    {
        return $user->userCanDo('Notice', 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userCanDo('Notice', 'add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Notice  $notice
     * @return mixed
     */
    public function update(User $user, Notice $notice)
    {
        return $user->userCanDo('Notice', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Notice  $notice
     * @return mixed
     */
    public function delete(User $user, Notice $notice)
    {
        return $user->userCanDo('Notice', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Notice  $notice
     * @return mixed
     */
    public function restore(User $user, Notice $notice)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Notice  $notice
     * @return mixed
     */
    public function forceDelete(User $user, Notice $notice)
    {
        return true;
    }
}
