<?php

namespace App\Policies\v1;

use App\Models\User;
use App\Models\v1\PersonalNotificationUser;
use Illuminate\Auth\Access\Response;

class PersonalNotificationUserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PersonalNotificationUser $personalNotificationUser): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PersonalNotificationUser $personalNotificationUser): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PersonalNotificationUser $personalNotificationUser): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PersonalNotificationUser $personalNotificationUser): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PersonalNotificationUser $personalNotificationUser): bool
    {
        //
    }
}
