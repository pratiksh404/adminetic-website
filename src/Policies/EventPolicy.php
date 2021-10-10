<?php

namespace Adminetic\Website\Policies;

use App\Models\User;
use Adminetic\Website\Models\Admin\Event;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
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
        return $user->userCanDo('Event', 'browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Event  $event
     * @return mixed
     */
    public function view(User $user, Event $event)
    {
        return $user->userCanDo('Event', 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userCanDo('Event', 'add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Event  $event
     * @return mixed
     */
    public function update(User $user, Event $event)
    {
        return $user->userCanDo('Event', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Event  $event
     * @return mixed
     */
    public function delete(User $user, Event $event)
    {
        return $user->userCanDo('Event', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Event  $event
     * @return mixed
     */
    public function restore(User $user, Event $event)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Event  $event
     * @return mixed
     */
    public function forceDelete(User $user, Event $event)
    {
        return true;
    }
}
