<?php

namespace App\Observers\v1;

use App\Events\v1\FAQEvent;
use App\Models\v1\FAQ;
use Illuminate\Support\Facades\Cache;

class FAQObserver
{
    /**
     * Handle the FAQ "created" event.
     */
    public function created(FAQ $faq): void
    {
        Cache::forget('FAQ');
        FAQEvent::dispatch('FAQ Created');
    }

    /**
     * Handle the FAQ "updated" event.
     */
    public function updated(FAQ $faq): void
    {
        Cache::forget('FAQ');
        FAQEvent::dispatch('FAQ Updated');
    }

    /**
     * Handle the FAQ "deleted" event.
     */
    public function deleted(FAQ $faq): void
    {
        Cache::forget('FAQ');
        FAQEvent::dispatch('FAQ Deleted');
    }

    /**
     * Handle the FAQ "restored" event.
     */
    public function restored(FAQ $faq): void
    {
        Cache::forget('FAQ');
        FAQEvent::dispatch('FAQ Restored');
    }

    /**
     * Handle the FAQ "force deleted" event.
     */
    public function forceDeleted(FAQ $faq): void
    {
        Cache::forget('FAQ');
        FAQEvent::dispatch('FAQ Delete Permanent');
    }
}
