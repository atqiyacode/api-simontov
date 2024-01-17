<?php

namespace App\Observers;

use App\Events\RangeCostEvent;
use App\Events\UserLogActivityEvent;
use App\Models\RangeCost;

class RangeCostObserver
{
    /**
     * Dispatch events and log activities when the RangeCost is created, updated, deleted, restored, or force deleted.
     *
     * @param \App\Models\RangeCost $data
     */
    protected function handleEventAndLogActivity(RangeCost $data): void
    {
        RangeCostEvent::dispatch($data);
        // UserLogActivityEvent::dispatch('new update');
    }
    /**
     * Handle the RangeCost "created" event.
     */
    public function created(RangeCost $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the RangeCost "updated" event.
     */
    public function updated(RangeCost $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the RangeCost "deleted" event.
     */
    public function deleted(RangeCost $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the RangeCost "restored" event.
     */
    public function restored(RangeCost $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the RangeCost "force deleted" event.
     */
    public function forceDeleted(RangeCost $data): void
    {
        $this->handleEventAndLogActivity($data);
    }
}
