<?php

namespace Adminetic\Website\Policies;

use Adminetic\Website\Models\Admin\Block;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlockPolicy
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
        return $user->userCanDo('Block', 'browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Block  $block
     * @return mixed
     */
    public function view(User $user, Block $block)
    {
        return $user->userCanDo('Block', 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userCanDo('Block', 'add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Block  $block
     * @return mixed
     */
    public function update(User $user, Block $block)
    {
        return $user->userCanDo('Block', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Block  $block
     * @return mixed
     */
    public function delete(User $user, Block $block)
    {
        return $user->userCanDo('Block', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Block  $block
     * @return mixed
     */
    public function restore(User $user, Block $block)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Block  $block
     * @return mixed
     */
    public function forceDelete(User $user, Block $block)
    {
        return true;
    }
}
