<?php

namespace Adminetic\Website\Policies;

use Adminetic\Website\Models\Admin\Testimonial;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestimonialPolicy
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
        return $user->userCanDo('Testimonial', 'browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Testimonial  $testimonial
     * @return mixed
     */
    public function view(User $user, Testimonial $testimonial)
    {
        return $user->userCanDo('Testimonial', 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userCanDo('Testimonial', 'add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Testimonial  $testimonial
     * @return mixed
     */
    public function update(User $user, Testimonial $testimonial)
    {
        return $user->userCanDo('Testimonial', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Testimonial  $testimonial
     * @return mixed
     */
    public function delete(User $user, Testimonial $testimonial)
    {
        return $user->userCanDo('Testimonial', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Testimonial  $testimonial
     * @return mixed
     */
    public function restore(User $user, Testimonial $testimonial)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Testimonial  $testimonial
     * @return mixed
     */
    public function forceDelete(User $user, Testimonial $testimonial)
    {
        return true;
    }
}
