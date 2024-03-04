<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Extoutbox;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExtoutboxPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the extoutbox can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list extoutboxes');
    }

    /**
     * Determine whether the extoutbox can view the model.
     */
    public function view(User $user, Extoutbox $model): bool
    {
        return $user->hasPermissionTo('view extoutboxes');
    }

    /**
     * Determine whether the extoutbox can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create extoutboxes');
    }

    /**
     * Determine whether the extoutbox can update the model.
     */
    public function update(User $user, Extoutbox $model): bool
    {
        return $user->hasPermissionTo('update extoutboxes');
    }

    /**
     * Determine whether the extoutbox can delete the model.
     */
    public function delete(User $user, Extoutbox $model): bool
    {
        return $user->hasPermissionTo('delete extoutboxes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete extoutboxes');
    }

    /**
     * Determine whether the extoutbox can restore the model.
     */
    public function restore(User $user, Extoutbox $model): bool
    {
        return false;
    }

    /**
     * Determine whether the extoutbox can permanently delete the model.
     */
    public function forceDelete(User $user, Extoutbox $model): bool
    {
        return false;
    }
}
