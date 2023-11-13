<?php

namespace App\Observers;

use App\Models\FailedJob;

class FailedJobObserver
{
    /**
     * Handle the FailedJob "created" event.
     */
    public function created(FailedJob $failedJob): void
    {
        //
    }

    /**
     * Handle the FailedJob "updated" event.
     */
    public function updated(FailedJob $failedJob): void
    {
        //
    }

    /**
     * Handle the FailedJob "deleted" event.
     */
    public function deleted(FailedJob $failedJob): void
    {
        //
    }

    /**
     * Handle the FailedJob "restored" event.
     */
    public function restored(FailedJob $failedJob): void
    {
        //
    }

    /**
     * Handle the FailedJob "force deleted" event.
     */
    public function forceDeleted(FailedJob $failedJob): void
    {
        //
    }
}
