<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Information;
use App\Models\User;

class InformationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any Information');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Information $information): bool
    {
        return $user->can('view Information');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create Information');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Information $information): bool
    {
        return $user->can('update Information');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Information $information): bool
    {
        return $user->can('delete Information');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Information $information): bool
    {
        return $user->can('restore Information');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Information $information): bool
    {
        return $user->can('force-delete Information');
    }
}
