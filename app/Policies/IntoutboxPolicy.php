<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Intoutbox;
use Illuminate\Auth\Access\HandlesAuthorization;

class IntoutboxPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the intoutbox can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list intoutboxes');
    }

    /**
     * Determine whether the intoutbox can view the model.
     */
    public function view(User $user, Intoutbox $model): bool
    {
        return $user->hasPermissionTo('view intoutboxes');
    }

    /**
     * Determine whether the intoutbox can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create intoutboxes');
    }

    /**
     * Determine whether the intoutbox can update the model.
     */
    public function update(User $user, Intoutbox $model): bool
    {
        return $user->hasPermissionTo('update intoutboxes');
    }

    /**
     * Determine whether the intoutbox can delete the model.
     */
    public function delete(User $user, Intoutbox $model): bool
    {
        return $user->hasPermissionTo('delete intoutboxes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete intoutboxes');
    }

    /**
     * Determine whether the intoutbox can restore the model.
     */
    public function restore(User $user, Intoutbox $model): bool
    {
        return false;
    }

    /**
     * Determine whether the intoutbox can permanently delete the model.
     */
    public function forceDelete(User $user, Intoutbox $model): bool
    {
        return false;
    }
}
