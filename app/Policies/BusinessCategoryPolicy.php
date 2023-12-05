<?php

namespace App\Policies;

use App\Models\BusinessCategory;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BusinessCategoryPolicy
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
    public function view(User $user, BusinessCategory $businessCategory): bool
    {
        return $businessCategory->user_id == $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BusinessCategory $businessCategory): bool
    {
        return $businessCategory->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BusinessCategory $businessCategory): bool
    {
        return $businessCategory->user_id == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BusinessCategory $businessCategory): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BusinessCategory $businessCategory): bool
    {
        //
    }
}
