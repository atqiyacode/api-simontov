<?php

namespace App\Observers\v1;

use App\Events\v1\MobileAppServerStatusEvent;
use App\Models\v1\MobileAppServerStatus;

class MobileAppServerStatusObserver
{
    /**
     * Handle the MobileAppServerStatus "created" event.
     */
    public function created(MobileAppServerStatus $mobileAppServerStatus): void
    {
        //
    }

    /**
     * Handle the MobileAppServerStatus "updated" event.
     */
    public function updated(MobileAppServerStatus $mobileAppServerStatus): void
    {
        MobileAppServerStatusEvent::dispatch('server updated');
    }

    /**
     * Handle the MobileAppServerStatus "deleted" event.
     */
    public function deleted(MobileAppServerStatus $mobileAppServerStatus): void
    {
        //
    }

    /**
     * Handle the MobileAppServerStatus "restored" event.
     */
    public function restored(MobileAppServerStatus $mobileAppServerStatus): void
    {
        //
    }

    /**
     * Handle the MobileAppServerStatus "force deleted" event.
     */
    public function forceDeleted(MobileAppServerStatus $mobileAppServerStatus): void
    {
        //
    }
}
