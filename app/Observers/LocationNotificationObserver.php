<?php

namespace App\Observers;

use App\Events\LocationNotificationEvent;
use App\Events\UserLogActivityEvent;
use App\Http\Resources\LocationNotification\LocationNotificationResource;
use App\Models\LocationNotification;

class LocationNotificationObserver
{
    /**
     * Dispatch events and log activities when the LocationNotification is created, updated, deleted, restored, or force deleted.
     *
     * @param \App\Models\LocationNotification $data
     */
    protected function handleEventAndLogActivity(LocationNotification $data): void
    {
        LocationNotificationEvent::dispatch(new LocationNotificationResource($data));
        // UserLogActivityEvent::dispatch('new update');
    }
    /**
     * Handle the LocationNotification "created" event.
     */
    public function created(LocationNotification $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the LocationNotification "updated" event.
     */
    public function updated(LocationNotification $data): void
    {
        // $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the LocationNotification "deleted" event.
     */
    public function deleted(LocationNotification $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the LocationNotification "restored" event.
     */
    public function restored(LocationNotification $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the LocationNotification "force deleted" event.
     */
    public function forceDeleted(LocationNotification $data): void
    {
        $this->handleEventAndLogActivity($data);
    }
}
