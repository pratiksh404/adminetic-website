<?php

namespace Adminetic\Website\Policies;

use Adminetic\Website\Models\Admin\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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
        return $user->userCanDo('Product', 'browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Product  $product
     * @return mixed
     */
    public function view(User $user, Product $product)
    {
        return $user->userCanDo('Product', 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userCanDo('Product', 'add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Product  $product
     * @return mixed
     */
    public function update(User $user, Product $product)
    {
        return $user->userCanDo('Product', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Product  $product
     * @return mixed
     */
    public function delete(User $user, Product $product)
    {
        return $user->userCanDo('Product', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Product  $product
     * @return mixed
     */
    public function restore(User $user, Product $product)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Adminetic\Website\Models\Admin\Product  $product
     * @return mixed
     */
    public function forceDelete(User $user, Product $product)
    {
        return true;
    }
}
