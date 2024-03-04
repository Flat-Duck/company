<?php

namespace App\Policies;

use App\Models\Memo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the memo can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list memos');
    }

    /**
     * Determine whether the memo can view the model.
     */
    public function view(User $user, Memo $model): bool
    {
        return $user->hasPermissionTo('view memos');
    }

    /**
     * Determine whether the memo can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create memos');
    }

    /**
     * Determine whether the memo can update the model.
     */
    public function update(User $user, Memo $model): bool
    {
        return $user->hasPermissionTo('update memos');
    }

    /**
     * Determine whether the memo can delete the model.
     */
    public function delete(User $user, Memo $model): bool
    {
        return $user->hasPermissionTo('delete memos');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete memos');
    }

    /**
     * Determine whether the memo can restore the model.
     */
    public function restore(User $user, Memo $model): bool
    {
        return false;
    }

    /**
     * Determine whether the memo can permanently delete the model.
     */
    public function forceDelete(User $user, Memo $model): bool
    {
        return false;
    }
}
