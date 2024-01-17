<?php

namespace App\Observers;

use App\Events\DashboardChartEvent;
use App\Events\UserLogActivityEvent;
use App\Models\DashboardChart;

class DashboardChartObserver
{
    /**
     * Dispatch events and log activities when the DashboardChart is created, updated, deleted, restored, or force deleted.
     *
     * @param \App\Models\DashboardChart $data
     */
    protected function handleEventAndLogActivity(DashboardChart $data): void
    {
        DashboardChartEvent::dispatch($data);
        // UserLogActivityEvent::dispatch('new update');
    }
    /**
     * Handle the DashboardChart "created" event.
     */
    public function created(DashboardChart $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the DashboardChart "updated" event.
     */
    public function updated(DashboardChart $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the DashboardChart "deleted" event.
     */
    public function deleted(DashboardChart $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the DashboardChart "restored" event.
     */
    public function restored(DashboardChart $data): void
    {
        $this->handleEventAndLogActivity($data);
    }

    /**
     * Handle the DashboardChart "force deleted" event.
     */
    public function forceDeleted(DashboardChart $data): void
    {
        $this->handleEventAndLogActivity($data);
    }
}
