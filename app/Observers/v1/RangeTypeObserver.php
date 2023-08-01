<?php

namespace App\Observers\v1;

use App\Models\v1\RangeType;

class RangeTypeObserver
{
    /**
     * Handle the RangeType "created" event.
     */
    public function created(RangeType $rangeType): void
    {
        //
    }

    /**
     * Handle the RangeType "updated" event.
     */
    public function updated(RangeType $rangeType): void
    {
        //
    }

    /**
     * Handle the RangeType "deleted" event.
     */
    public function deleted(RangeType $rangeType): void
    {
        //
    }

    /**
     * Handle the RangeType "restored" event.
     */
    public function restored(RangeType $rangeType): void
    {
        //
    }

    /**
     * Handle the RangeType "force deleted" event.
     */
    public function forceDeleted(RangeType $rangeType): void
    {
        //
    }
}
