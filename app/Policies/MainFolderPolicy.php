<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MainFolder;
use Illuminate\Auth\Access\HandlesAuthorization;

class MainFolderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the mainFolder can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list mainfolders');
    }

    /**
     * Determine whether the mainFolder can view the model.
     */
    public function view(User $user, MainFolder $model): bool
    {
        return $user->hasPermissionTo('view mainfolders');
    }

    /**
     * Determine whether the mainFolder can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create mainfolders');
    }

    /**
     * Determine whether the mainFolder can update the model.
     */
    public function update(User $user, MainFolder $model): bool
    {
        return $user->hasPermissionTo('update mainfolders');
    }

    /**
     * Determine whether the mainFolder can delete the model.
     */
    public function delete(User $user, MainFolder $model): bool
    {
        return $user->hasPermissionTo('delete mainfolders');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete mainfolders');
    }

    /**
     * Determine whether the mainFolder can restore the model.
     */
    public function restore(User $user, MainFolder $model): bool
    {
        return false;
    }

    /**
     * Determine whether the mainFolder can permanently delete the model.
     */
    public function forceDelete(User $user, MainFolder $model): bool
    {
        return false;
    }
}
