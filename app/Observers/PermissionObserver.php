<?php

namespace App\Observers;

use App\Events\PermissionEvent;
use App\Events\UserLogActivityEvent;
use App\Models\Permission;

class PermissionObserver
{
    /**
     * Dispatch events and log activities when the Permission is created, updated, deleted, restored, or force deleted.
     *
     * @param \App\Models\Permission $data
     */
    protected function handleEventAndLogActivity(Permission $data): void
    {
        PermissionEvent::dispatch($data);
        // UserLogActivityEvent::dispatch('new update');
    }
    /**
     * Handle the Permission "created" event.
     */
    public function created(Permission $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Permission "updated" event.
     */
    public function updated(Permission $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Permission "deleted" event.
     */
    public function deleted(Permission $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Permission "restored" event.
     */
    public function restored(Permission $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Permission "force deleted" event.
     */
    public function forceDeleted(Permission $data): void
    {
        $this->handleEventAndLogActivity($data);
    }
}
