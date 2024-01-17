<?php

namespace App\Observers;

use App\Events\StatusAlarmEvent;
use App\Events\UserLogActivityEvent;
use App\Models\StatusAlarm;

class StatusAlarmObserver
{
    /**
     * Dispatch events and log activities when the StatusAlarm is created, updated, deleted, restored, or force deleted.
     *
     * @param \App\Models\StatusAlarm $data
     */
    protected function handleEventAndLogActivity(StatusAlarm $data): void
    {
        StatusAlarmEvent::dispatch($data);
        // UserLogActivityEvent::dispatch('new update');
    }
    /**
     * Handle the StatusAlarm "created" event.
     */
    public function created(StatusAlarm $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the StatusAlarm "updated" event.
     */
    public function updated(StatusAlarm $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the StatusAlarm "deleted" event.
     */
    public function deleted(StatusAlarm $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the StatusAlarm "restored" event.
     */
    public function restored(StatusAlarm $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the StatusAlarm "force deleted" event.
     */
    public function forceDeleted(StatusAlarm $data): void
    {
        $this->handleEventAndLogActivity($data);
    }
}
