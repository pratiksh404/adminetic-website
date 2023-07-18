<?php

namespace Adminetic\Website\Policies;

use Adminetic\Website\Models\Admin\About;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AboutPolicy
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
        return $user->userCanDo('About', 'browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\About  $about
     * @return mixed
     */
    public function view(User $user, About $about)
    {
        return $user->userCanDo('About', 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userCanDo('About', 'add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\About  $about
     * @return mixed
     */
    public function update(User $user, About $about)
    {
        return $user->userCanDo('About', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\About  $about
     * @return mixed
     */
    public function delete(User $user, About $about)
    {
        return $user->userCanDo('About', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\About  $about
     * @return mixed
     */
    public function restore(User $user, About $about)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\About  $about
     * @return mixed
     */
    public function forceDelete(User $user, About $about)
    {
        return true;
    }
}
