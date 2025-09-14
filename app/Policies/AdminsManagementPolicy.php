<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdminsManagementPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $user)
    {
        return $user->can('view-admin');
    }

    /**س
     * Determine whether the user can view the model.
     */

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $user)
    {
        return $user->can('create-admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $user, Admin $target)
    {
         if ($user->can('update-admin')) {
            return !$target->hasRole('superadmin') && !$target->hasRole('admin');
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, Admin $target)
    {
        if ($user->can('delete-admin')) {
            return !$target->hasRole('superadmin') && !$target->hasRole('admin');
        }
        return false;
    }
}
