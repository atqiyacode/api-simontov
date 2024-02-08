<?php

namespace App\Observers;

use App\Events\AlertElectricityEvent;
use App\Events\FlowrateEvent;
use App\Http\Resources\Flowrate\FlowrateResource;
use App\Jobs\CodCheckJob;
use App\Jobs\DataNotEnteredCheckJob;
use App\Jobs\ElectricityCheckJob;
use App\Jobs\PhCheckJob;
use App\Jobs\TotalizerCheckJob;
use App\Models\Flowrate;
use App\Models\LocationNotification;

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
        CodCheckJob::dispatch($data);
        PhCheckJob::dispatch($data);
        ElectricityCheckJob::dispatch($data);
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
