<?php

namespace App\Observers;

use App\Models\DashboardChart;

class DashboardChartObserver
{
    /**
     * Handle the DashboardChart "created" event.
     */
    public function created(DashboardChart $dashboardChart): void
    {
        //
    }

    /**
     * Handle the DashboardChart "updated" event.
     */
    public function updated(DashboardChart $dashboardChart): void
    {
        //
    }

    /**
     * Handle the DashboardChart "deleted" event.
     */
    public function deleted(DashboardChart $dashboardChart): void
    {
        //
    }

    /**
     * Handle the DashboardChart "restored" event.
     */
    public function restored(DashboardChart $dashboardChart): void
    {
        //
    }

    /**
     * Handle the DashboardChart "force deleted" event.
     */
    public function forceDeleted(DashboardChart $dashboardChart): void
    {
        //
    }
}
