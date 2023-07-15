<?php

namespace App\Observers\v1;

use App\Events\v1\PersonalNotificationUserEvent;
use App\Models\v1\PersonalNotificationUser;

class PersonalNotificationUserObserver
{
    /**
     * Handle the PersonalNotificationUser "created" event.
     */
    public function created(PersonalNotificationUser $personalNotificationUser): void
    {
        PersonalNotificationUserEvent::dispatch($personalNotificationUser);
    }

    /**
     * Handle the PersonalNotificationUser "updated" event.
     */
    public function updated(PersonalNotificationUser $personalNotificationUser): void
    {
        // PersonalNotificationUserEvent::dispatch($personalNotificationUser);
    }

    /**
     * Handle the PersonalNotificationUser "deleted" event.
     */
    public function deleted(PersonalNotificationUser $personalNotificationUser): void
    {
        // PersonalNotificationUserEvent::dispatch($personalNotificationUser);
    }

    /**
     * Handle the PersonalNotificationUser "restored" event.
     */
    public function restored(PersonalNotificationUser $personalNotificationUser): void
    {
        // PersonalNotificationUserEvent::dispatch($personalNotificationUser);
    }

    /**
     * Handle the PersonalNotificationUser "force deleted" event.
     */
    public function forceDeleted(PersonalNotificationUser $personalNotificationUser): void
    {
        // PersonalNotificationUserEvent::dispatch($personalNotificationUser);
    }
}
