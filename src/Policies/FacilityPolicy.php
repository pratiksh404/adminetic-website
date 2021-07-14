<?php

namespace App\Policies;

use App\Models\Admin\Facility;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FacilityPolicy
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
        return $user->userCanDo('Facility', 'browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Facility  $facility
     * @return mixed
     */
    public function view(User $user, Facility $facility)
    {
        return $user->userCanDo('Facility', 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userCanDo('Facility', 'add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Facility  $facility
     * @return mixed
     */
    public function update(User $user, Facility $facility)
    {
        return $user->userCanDo('Facility', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Facility  $facility
     * @return mixed
     */
    public function delete(User $user, Facility $facility)
    {
        return $user->userCanDo('Facility', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Facility  $facility
     * @return mixed
     */
    public function restore(User $user, Facility $facility)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Facility  $facility
     * @return mixed
     */
    public function forceDelete(User $user, Facility $facility)
    {
        return true;
    }
}
