<?php

namespace App\Observers\v1;

use App\Events\v1\DeveloperNoteEvent;
use App\Models\v1\DeveloperNote;
use Illuminate\Support\Facades\Cache;

class DeveloperNoteObserver
{
    /**
     * Handle the DeveloperNote "created" event.
     */
    public function created(DeveloperNote $developerNote): void
    {
        Cache::forget('developerNote');
        DeveloperNoteEvent::dispatch('Developer Note Created');
    }

    /**
     * Handle the DeveloperNote "updated" event.
     */
    public function updated(DeveloperNote $developerNote): void
    {
        Cache::forget('developerNote');
        DeveloperNoteEvent::dispatch('Developer Note Updated');
    }

    /**
     * Handle the DeveloperNote "deleted" event.
     */
    public function deleted(DeveloperNote $developerNote): void
    {
        Cache::forget('developerNote');
        DeveloperNoteEvent::dispatch('Developer Note Deleted');
    }

    /**
     * Handle the DeveloperNote "restored" event.
     */
    public function restored(DeveloperNote $developerNote): void
    {
        Cache::forget('developerNote');
        DeveloperNoteEvent::dispatch('Developer Note Restored');
    }

    /**
     * Handle the DeveloperNote "force deleted" event.
     */
    public function forceDeleted(DeveloperNote $developerNote): void
    {
        Cache::forget('developerNote');
        DeveloperNoteEvent::dispatch('Developer Note Delete Permanent');
    }
}
