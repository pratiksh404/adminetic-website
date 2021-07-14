<?php

namespace App\Policies;

use App\Models\Admin\Faq;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FaqPolicy
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
        return $user->userCanDo('Faq', 'browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Faq  $faq
     * @return mixed
     */
    public function view(User $user, Faq $faq)
    {
        return $user->userCanDo('Faq', 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userCanDo('Faq', 'add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Faq  $faq
     * @return mixed
     */
    public function update(User $user, Faq $faq)
    {
        return $user->userCanDo('Faq', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Faq  $faq
     * @return mixed
     */
    public function delete(User $user, Faq $faq)
    {
        return $user->userCanDo('Faq', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Faq  $faq
     * @return mixed
     */
    public function restore(User $user, Faq $faq)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Faq  $faq
     * @return mixed
     */
    public function forceDelete(User $user, Faq $faq)
    {
        return true;
    }
}
