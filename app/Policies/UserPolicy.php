<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     * Only admins can view the users listing.
     */
    public function viewAny(User $user)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view the model.
     * Admins can view any user. Users can view their own profile.
     */
    public function view(User $user, User $model)
    {
        return $user->role === 'admin' || $user->id === $model->id;
    }

    /**
     * Determine whether the user can create models.
     * Allow registration by default.
     */
    public function create(?User $user = null)
    {
        // Allow guests and normal users to create an account (registration).
        // Prevent admins from creating accounts via the app UI so they only
        // have view/delete privileges as requested.
        return is_null($user) || ($user->role ?? 'user') === 'user';
    }

    /**
     * Determine whether the user can update the model.
     * Only the owner may update their own account (admins are not allowed to update other users).
     */
    public function update(User $user, User $model)
    {
        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     * Admins can delete any user. Users can delete their own account.
     */
    public function delete(User $user, User $model)
    {
        return $user->role === 'admin' || $user->id === $model->id;
    }
}
