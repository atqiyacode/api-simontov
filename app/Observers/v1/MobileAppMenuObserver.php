<?php

namespace App\Observers\v1;

use App\Events\v1\MobileAppMenuEvent;
use App\Models\v1\MobileAppMenu;
use Illuminate\Support\Facades\Cache;

class MobileAppMenuObserver
{
    /**
     * Handle the MobileAppMenu "created" event.
     */
    public function created(MobileAppMenu $mobileAppMenu): void
    {
        Cache::forget('mobileAppMenu');
        MobileAppMenuEvent::dispatch('data updated');
    }

    /**
     * Handle the MobileAppMenu "updated" event.
     */
    public function updated(MobileAppMenu $mobileAppMenu): void
    {
        Cache::forget('mobileAppMenu');
        MobileAppMenuEvent::dispatch('data updated');
    }

    /**
     * Handle the MobileAppMenu "deleted" event.
     */
    public function deleted(MobileAppMenu $mobileAppMenu): void
    {
        Cache::forget('mobileAppMenu');
        MobileAppMenuEvent::dispatch('data updated');
    }
}
