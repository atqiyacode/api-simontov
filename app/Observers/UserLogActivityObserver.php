<?php

namespace App\Observers;

use App\Events\UserLogActivityEvent;
use App\Models\UserLogActivity;

class UserLogActivityObserver
{
    /**
     * Dispatch events and log activities when the UserLogActivity is created, updated, deleted, restored, or force deleted.
     *
     * @param \App\Models\UserLogActivity $data
     */
    protected function handleEventAndLogActivity(UserLogActivity $data): void
    {
        UserLogActivityEvent::dispatch($data);
    }
    /**
     * Handle the UserLogActivity "created" event.
     */
    public function created(UserLogActivity $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the UserLogActivity "updated" event.
     */
    public function updated(UserLogActivity $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the UserLogActivity "deleted" event.
     */
    public function deleted(UserLogActivity $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the UserLogActivity "restored" event.
     */
    public function restored(UserLogActivity $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the UserLogActivity "force deleted" event.
     */
    public function forceDeleted(UserLogActivity $data): void
    {
        $this->handleEventAndLogActivity($data);
    }
}
