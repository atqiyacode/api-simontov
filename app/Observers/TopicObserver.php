<?php

namespace App\Observers;

use App\Events\TopicEvent;
use App\Events\UserLogActivityEvent;
use App\Models\Topic;

class TopicObserver
{
    /**
     * Dispatch events and log activities when the Topic is created, updated, deleted, restored, or force deleted.
     *
     * @param \App\Models\Topic $data
     */
    protected function handleEventAndLogActivity(Topic $data): void
    {
        TopicEvent::dispatch($data);
        // UserLogActivityEvent::dispatch('new update');
    }
    /**
     * Handle the Topic "created" event.
     */
    public function created(Topic $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Topic "updated" event.
     */
    public function updated(Topic $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Topic "deleted" event.
     */
    public function deleted(Topic $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Topic "restored" event.
     */
    public function restored(Topic $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the Topic "force deleted" event.
     */
    public function forceDeleted(Topic $data): void
    {
        $this->handleEventAndLogActivity($data);
    }
}
