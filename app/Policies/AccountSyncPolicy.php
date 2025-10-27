<?php

namespace App\Policies;

use App\Models\AccountSync;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AccountSyncPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Authenticated users can view their own syncs
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AccountSync $accountSync): bool
    {
        return $user->id === $accountSync->userId;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Authenticated users can create syncs
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AccountSync $accountSync): bool
    {
        return $user->id === $accountSync->userId;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AccountSync $accountSync): bool
    {
        return $user->id === $accountSync->userId;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AccountSync $accountSync): bool
    {
        return $user->id === $accountSync->userId;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AccountSync $accountSync): bool
    {
        return $user->id === $accountSync->userId;
    }
}
