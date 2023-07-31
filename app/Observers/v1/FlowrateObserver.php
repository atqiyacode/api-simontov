<?php

namespace App\Observers\v1;

use App\Models\v1\Flowrate;

class FlowrateObserver
{
    /**
     * Handle the Flowrate "created" event.
     */
    public function created(Flowrate $flowrate): void
    {
        //
    }

    /**
     * Handle the Flowrate "updated" event.
     */
    public function updated(Flowrate $flowrate): void
    {
        //
    }

    /**
     * Handle the Flowrate "deleted" event.
     */
    public function deleted(Flowrate $flowrate): void
    {
        //
    }

    /**
     * Handle the Flowrate "restored" event.
     */
    public function restored(Flowrate $flowrate): void
    {
        //
    }

    /**
     * Handle the Flowrate "force deleted" event.
     */
    public function forceDeleted(Flowrate $flowrate): void
    {
        //
    }
}
