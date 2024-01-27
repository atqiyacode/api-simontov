<?php

namespace App\Observers;

use App\Models\AlertNotificationType;

class AlertNotificationTypeObserver
{
    /**
     * Handle the AlertNotificationType "created" event.
     */
    public function created(AlertNotificationType $alertNotificationType): void
    {
        //
    }

    /**
     * Handle the AlertNotificationType "updated" event.
     */
    public function updated(AlertNotificationType $alertNotificationType): void
    {
        //
    }

    /**
     * Handle the AlertNotificationType "deleted" event.
     */
    public function deleted(AlertNotificationType $alertNotificationType): void
    {
        //
    }

    /**
     * Handle the AlertNotificationType "restored" event.
     */
    public function restored(AlertNotificationType $alertNotificationType): void
    {
        //
    }

    /**
     * Handle the AlertNotificationType "force deleted" event.
     */
    public function forceDeleted(AlertNotificationType $alertNotificationType): void
    {
        //
    }
}
