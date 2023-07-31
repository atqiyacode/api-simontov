<?php

namespace App\Observers\v1;

use App\Models\v1\StatusAlarm;

class StatusAlarmObserver
{
    /**
     * Handle the StatusAlarm "created" event.
     */
    public function created(StatusAlarm $statusAlarm): void
    {
        //
    }

    /**
     * Handle the StatusAlarm "updated" event.
     */
    public function updated(StatusAlarm $statusAlarm): void
    {
        //
    }

    /**
     * Handle the StatusAlarm "deleted" event.
     */
    public function deleted(StatusAlarm $statusAlarm): void
    {
        //
    }

    /**
     * Handle the StatusAlarm "restored" event.
     */
    public function restored(StatusAlarm $statusAlarm): void
    {
        //
    }

    /**
     * Handle the StatusAlarm "force deleted" event.
     */
    public function forceDeleted(StatusAlarm $statusAlarm): void
    {
        //
    }
}
