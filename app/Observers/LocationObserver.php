<?php

namespace App\Observers;

use App\Events\LocationEvent;
use App\Events\UserLogActivityEvent;
use App\Models\Location;

class LocationObserver
{
    /**
     * Dispatch events and log activities when the Location is created, updated, deleted, restored, or force deleted.
     *
     * @param \App\Models\Location $data
     */
    protected function handleEventAndLogActivity(Location $data): void
    {
        LocationEvent::dispatch($data);
        // UserLogActivityEvent::dispatch('new update');
    }
    /**
     * Handle the Location "created" event.
     */
    public function created(Location $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Location "updated" event.
     */
    public function updated(Location $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Location "deleted" event.
     */
    public function deleted(Location $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Location "restored" event.
     */
    public function restored(Location $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Location "force deleted" event.
     */
    public function forceDeleted(Location $data): void
    {
        $this->handleEventAndLogActivity($data);
    }
}
