<?php

namespace Adminetic\Website\Policies;

use Adminetic\Website\Models\Admin\Popup;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PopupPolicy
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
        return $user->userCanDo('Popup', 'browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Popup  $popup
     * @return mixed
     */
    public function view(User $user, Popup $popup)
    {
        return $user->userCanDo('Popup', 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userCanDo('Popup', 'add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Popup  $popup
     * @return mixed
     */
    public function update(User $user, Popup $popup)
    {
        return $user->userCanDo('Popup', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Popup  $popup
     * @return mixed
     */
    public function delete(User $user, Popup $popup)
    {
        return $user->userCanDo('Popup', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Popup  $popup
     * @return mixed
     */
    public function restore(User $user, Popup $popup)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Popup  $popup
     * @return mixed
     */
    public function forceDelete(User $user, Popup $popup)
    {
        return true;
    }
}
