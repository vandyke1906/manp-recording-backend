<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Constants\Roles;
use Illuminate\Support\Facades\Log;

class ApplicationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, [
            Roles::PROPONENTS,
            Roles::RPS_TEAM,
            Roles::MANAGER,
            Roles::ADMINISTRATOR,
        ]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Application $application): bool
    {
        switch ($user->role) {
            case Roles::PROPONENTS: return $user->id === $application->user_id;
            case Roles::RPS_TEAM:
            case Roles::MANAGER:
            case Roles::ADMINISTRATOR: return true;
            default: return false;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Application $application): bool
    {
        return $user->id === $application->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Application $application): bool
    {
        return $user->id === $application->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Application $application): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Application $application): bool
    {
        return false;
    }
}
