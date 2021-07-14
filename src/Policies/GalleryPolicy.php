<?php

namespace App\Policies;

use App\Models\Admin\Gallery;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GalleryPolicy
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
        return $user->userCanDo('Gallery', 'browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Gallery  $gallery
     * @return mixed
     */
    public function view(User $user, Gallery $gallery)
    {
        return $user->userCanDo('Gallery', 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userCanDo('Gallery', 'add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Gallery  $gallery
     * @return mixed
     */
    public function update(User $user, Gallery $gallery)
    {
        return $user->userCanDo('Gallery', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Gallery  $gallery
     * @return mixed
     */
    public function delete(User $user, Gallery $gallery)
    {
        return $user->userCanDo('Gallery', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Gallery  $gallery
     * @return mixed
     */
    public function restore(User $user, Gallery $gallery)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Gallery  $gallery
     * @return mixed
     */
    public function forceDelete(User $user, Gallery $gallery)
    {
        return true;
    }
}
