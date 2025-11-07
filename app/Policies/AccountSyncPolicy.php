<?php

namespace App\Policies;

use App\Models\AccountSync;
use App\Models\UserAccount;
use Illuminate\Auth\Access\Response;

class AccountSyncPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserAccount $userAccount): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserAccount $userAccount, AccountSync $accountSync): bool
    {
        return $userAccount->email === 'admin@user.com' || $userAccount->user_account_id === $accountSync->user_account_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserAccount $userAccount): bool
    {
        // Any authenticated user can create a sync record.
        // The controller will handle associating it with the correct user.
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(UserAccount $userAccount, AccountSync $accountSync): bool
    {
        return $userAccount->email === 'admin@user.com' || $userAccount->user_account_id === $accountSync->user_account_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserAccount $userAccount, AccountSync $accountSync): bool
    {
        return $userAccount->email === 'admin@user.com' || $userAccount->user_account_id === $accountSync->user_account_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserAccount $userAccount, AccountSync $accountSync): bool
    {
        return $userAccount->email === 'admin@user.com';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserAccount $userAccount, AccountSync $accountSync): bool
    {
        return $userAccount->email === 'admin@user.com';
    }

    /**
     * Determine whether the user can trigger a sync.
     */
    public function syncNow(UserAccount $userAccount, AccountSync $accountSync): bool
    {
        return $userAccount->email === 'admin@user.com' || $userAccount->user_account_id === $accountSync->user_account_id;
    }
}
