<?php

namespace App\Observers;

use App\Events\RoleEvent;
use App\Events\UserLogActivityEvent;
use App\Models\Role;

class RoleObserver
{
    /**
     * Dispatch events and log activities when the Role is created, updated, deleted, restored, or force deleted.
     *
     * @param \App\Models\Role $data
     */
    protected function handleEventAndLogActivity(Role $data): void
    {
        RoleEvent::dispatch($data);
        // UserLogActivityEvent::dispatch('new update');
    }
    /**
     * Handle the Role "created" event.
     */
    public function created(Role $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Role "updated" event.
     */
    public function updated(Role $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Role "deleted" event.
     */
    public function deleted(Role $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Role "restored" event.
     */
    public function restored(Role $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Role "force deleted" event.
     */
    public function forceDeleted(Role $data): void
    {
        $this->handleEventAndLogActivity($data);
    }
}
