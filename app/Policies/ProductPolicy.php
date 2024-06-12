<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user->checkPermissionAccess(config('permissions.access.product-list'));

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionAccess(config('permissions.access.product-add'));

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user ,$id): bool
    {
        $product =DB::table('products')->find($id) ;

        if($user->checkPermissionAccess(config('permissions.access.product-edit')) && $user->id === $product->user_id){
            return true;
        }
        return false ;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->checkPermissionAccess(config('permissions.access.product-delete'));

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user): bool
    {
        //
    }
}
