<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Office;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfficePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the office can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list offices');
    }

    /**
     * Determine whether the office can view the model.
     */
    public function view(User $user, Office $model): bool
    {
        return $user->hasPermissionTo('view offices');
    }

    /**
     * Determine whether the office can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create offices');
    }

    /**
     * Determine whether the office can update the model.
     */
    public function update(User $user, Office $model): bool
    {
        return $user->hasPermissionTo('update offices');
    }

    /**
     * Determine whether the office can delete the model.
     */
    public function delete(User $user, Office $model): bool
    {
        return $user->hasPermissionTo('delete offices');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete offices');
    }

    /**
     * Determine whether the office can restore the model.
     */
    public function restore(User $user, Office $model): bool
    {
        return false;
    }

    /**
     * Determine whether the office can permanently delete the model.
     */
    public function forceDelete(User $user, Office $model): bool
    {
        return false;
    }
}
