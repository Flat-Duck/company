<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SubFolder;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubFolderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the subFolder can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list subfolders');
    }

    /**
     * Determine whether the subFolder can view the model.
     */
    public function view(User $user, SubFolder $model): bool
    {
        return $user->hasPermissionTo('view subfolders');
    }

    /**
     * Determine whether the subFolder can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create subfolders');
    }

    /**
     * Determine whether the subFolder can update the model.
     */
    public function update(User $user, SubFolder $model): bool
    {
        return $user->hasPermissionTo('update subfolders');
    }

    /**
     * Determine whether the subFolder can delete the model.
     */
    public function delete(User $user, SubFolder $model): bool
    {
        return $user->hasPermissionTo('delete subfolders');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete subfolders');
    }

    /**
     * Determine whether the subFolder can restore the model.
     */
    public function restore(User $user, SubFolder $model): bool
    {
        return false;
    }

    /**
     * Determine whether the subFolder can permanently delete the model.
     */
    public function forceDelete(User $user, SubFolder $model): bool
    {
        return false;
    }
}
