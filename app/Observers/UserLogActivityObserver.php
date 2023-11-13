<?php

namespace App\Observers;

use App\Models\UserLogActivity;

class UserLogActivityObserver
{
    /**
     * Handle the UserLogActivity "created" event.
     */
    public function created(UserLogActivity $userLogActivity): void
    {
        //
    }

    /**
     * Handle the UserLogActivity "updated" event.
     */
    public function updated(UserLogActivity $userLogActivity): void
    {
        //
    }

    /**
     * Handle the UserLogActivity "deleted" event.
     */
    public function deleted(UserLogActivity $userLogActivity): void
    {
        //
    }

    /**
     * Handle the UserLogActivity "restored" event.
     */
    public function restored(UserLogActivity $userLogActivity): void
    {
        //
    }

    /**
     * Handle the UserLogActivity "force deleted" event.
     */
    public function forceDeleted(UserLogActivity $userLogActivity): void
    {
        //
    }
}
