<?php

namespace App\Observers;

use App\Events\TaxEvent;
use App\Events\UserLogActivityEvent;
use App\Models\Tax;

class TaxObserver
{
    /**
     * Dispatch events and log activities when the Tax is created, updated, deleted, restored, or force deleted.
     *
     * @param \App\Models\Tax $data
     */
    protected function handleEventAndLogActivity(Tax $data): void
    {
        TaxEvent::dispatch($data);
        // UserLogActivityEvent::dispatch('new update');
    }
    /**
     * Handle the Tax "created" event.
     */
    public function created(Tax $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Tax "updated" event.
     */
    public function updated(Tax $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Tax "deleted" event.
     */
    public function deleted(Tax $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Tax "restored" event.
     */
    public function restored(Tax $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Tax "force deleted" event.
     */
    public function forceDeleted(Tax $data): void
    {
        $this->handleEventAndLogActivity($data);
    }
}
