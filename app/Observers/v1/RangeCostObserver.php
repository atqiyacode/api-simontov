<?php

namespace App\Observers\v1;

use App\Models\v1\RangeCost;

class RangeCostObserver
{
    /**
     * Handle the RangeCost "created" event.
     */
    public function created(RangeCost $rangeCost): void
    {
        //
    }

    /**
     * Handle the RangeCost "updated" event.
     */
    public function updated(RangeCost $rangeCost): void
    {
        //
    }

    /**
     * Handle the RangeCost "deleted" event.
     */
    public function deleted(RangeCost $rangeCost): void
    {
        //
    }

    /**
     * Handle the RangeCost "restored" event.
     */
    public function restored(RangeCost $rangeCost): void
    {
        //
    }

    /**
     * Handle the RangeCost "force deleted" event.
     */
    public function forceDeleted(RangeCost $rangeCost): void
    {
        //
    }
}
