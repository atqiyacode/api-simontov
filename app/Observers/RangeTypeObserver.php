<?php

namespace App\Observers;

use App\Events\RangeTypeEvent;
use App\Events\UserLogActivityEvent;
use App\Models\RangeType;

class RangeTypeObserver
{
    /**
     * Dispatch events and log activities when the RangeType is created, updated, deleted, restored, or force deleted.
     *
     * @param \App\Models\RangeType $data
     */
    protected function handleEventAndLogActivity(RangeType $data): void
    {
        RangeTypeEvent::dispatch($data);
        // UserLogActivityEvent::dispatch('new update');
    }
    /**
     * Handle the RangeType "created" event.
     */
    public function created(RangeType $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the RangeType "updated" event.
     */
    public function updated(RangeType $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the RangeType "deleted" event.
     */
    public function deleted(RangeType $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the RangeType "restored" event.
     */
    public function restored(RangeType $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the RangeType "force deleted" event.
     */
    public function forceDeleted(RangeType $data): void
    {
        $this->handleEventAndLogActivity($data);
    }
}
