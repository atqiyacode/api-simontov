<?php

namespace App\Observers;

use App\Events\FlowrateEvent;
use App\Events\UserLogActivityEvent;
use App\Http\Resources\Flowrate\FlowrateResource;
use App\Jobs\CodCheckJob;
use App\Jobs\ElectricityCheckJob;
use App\Models\Flowrate;

class FlowrateObserver
{
    /**
     * Dispatch events and log activities when the Flowrate is created, updated, deleted, restored, or force deleted.
     *
     * @param \App\Models\Flowrate $data
     */
    protected function handleEventAndLogActivity(Flowrate $data): void
    {
        FlowrateEvent::dispatch(new FlowrateResource($data));
        dispatch(new ElectricityCheckJob($data));
    }
    /**
     * Handle the Flowrate "created" event.
     */
    public function created(Flowrate $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Flowrate "updated" event.
     */
    public function updated(Flowrate $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Flowrate "deleted" event.
     */
    public function deleted(Flowrate $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Flowrate "restored" event.
     */
    public function restored(Flowrate $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Flowrate "force deleted" event.
     */
    public function forceDeleted(Flowrate $data): void
    {
        $this->handleEventAndLogActivity($data);
    }
}
