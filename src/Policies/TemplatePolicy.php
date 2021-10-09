<?php

namespace Adminetic\Website\Policies;

use Adminetic\Website\Models\Admin\Template;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TemplatePolicy
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
     * @param  \Adminetic\Website\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->userCanDo('Template', 'browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Adminetic\Website\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Template  $template
     * @return mixed
     */
    public function view(User $user, Template $template)
    {
        return $user->userCanDo('Template', 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Adminetic\Website\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userCanDo('Template', 'add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Adminetic\Website\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Template  $template
     * @return mixed
     */
    public function update(User $user, Template $template)
    {
        return $user->userCanDo('Template', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Adminetic\Website\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Template  $template
     * @return mixed
     */
    public function delete(User $user, Template $template)
    {
        return $user->userCanDo('Template', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \Adminetic\Website\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Template  $template
     * @return mixed
     */
    public function restore(User $user, Template $template)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \Adminetic\Website\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Template  $template
     * @return mixed
     */
    public function forceDelete(User $user, Template $template)
    {
        return true;
    }
}
