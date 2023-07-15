<?php

namespace App\Observers\v1;

use App\Events\v1\MobileVersionEvent;
use App\Models\v1\MobileVersion;

class MobileVersionOberver
{
    /**
     * Handle the MobileVersion "created" event.
     */
    public function created(MobileVersion $mobileVersion): void
    {
        MobileVersionEvent::dispatch('data created');
    }

    /**
     * Handle the MobileVersion "updated" event.
     */
    public function updated(MobileVersion $mobileVersion): void
    {
        MobileVersionEvent::dispatch('data updated');
    }

    /**
     * Handle the MobileVersion "deleted" event.
     */
    public function deleted(MobileVersion $mobileVersion): void
    {
        MobileVersionEvent::dispatch('data deleted');
    }
}
