<?php

namespace App\Observers;

use App\Events\UserDetailEvent;
use App\Events\UserEvent;
use App\Events\UserLocationEvent;
use App\Events\UserLogActivityEvent;
use App\Models\User;

class UserObserver
{
    /**
     * Dispatch events and log activities when the User is created, updated, deleted, restored, or force deleted.
     *
     * @param \App\Models\User $data
     */
    protected function handleEventAndLogActivity(User $data): void
    {
        UserEvent::dispatch($data);
        UserDetailEvent::dispatch($data);
        UserLocationEvent::dispatch($data);
        // UserLogActivityEvent::dispatch('new update');
    }
    /**
     * Handle the User "created" event.
     */
    public function created(User $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $data): void
    {
        $this->handleEventAndLogActivity($data);
    }
}
