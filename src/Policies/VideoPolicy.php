<?php

namespace Adminetic\Website\Policies;

use Adminetic\Website\Models\Admin\Video;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
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
        return $user->userCanDo('Video', 'browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Video  $video
     * @return mixed
     */
    public function view(User $user, Video $video)
    {
        return $user->userCanDo('Video', 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userCanDo('Video', 'add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Video  $video
     * @return mixed
     */
    public function update(User $user, Video $video)
    {
        return $user->userCanDo('Video', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Video  $video
     * @return mixed
     */
    public function delete(User $user, Video $video)
    {
        return $user->userCanDo('Video', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Video  $video
     * @return mixed
     */
    public function restore(User $user, Video $video)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Video  $video
     * @return mixed
     */
    public function forceDelete(User $user, Video $video)
    {
        return true;
    }
}
