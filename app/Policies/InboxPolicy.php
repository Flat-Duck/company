<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Inbox;
use Illuminate\Auth\Access\HandlesAuthorization;

class InboxPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the inbox can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list inboxes');
    }

    /**
     * Determine whether the inbox can view the model.
     */
    public function view(User $user, Inbox $model): bool
    {
        return $user->hasPermissionTo('view inboxes');
    }

    /**
     * Determine whether the inbox can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create inboxes');
    }

    /**
     * Determine whether the inbox can update the model.
     */
    public function update(User $user, Inbox $model): bool
    {
        return $user->hasPermissionTo('update inboxes');
    }

    /**
     * Determine whether the inbox can delete the model.
     */
    public function delete(User $user, Inbox $model): bool
    {
        return $user->hasPermissionTo('delete inboxes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete inboxes');
    }

    /**
     * Determine whether the inbox can restore the model.
     */
    public function restore(User $user, Inbox $model): bool
    {
        return false;
    }

    /**
     * Determine whether the inbox can permanently delete the model.
     */
    public function forceDelete(User $user, Inbox $model): bool
    {
        return false;
    }
}
