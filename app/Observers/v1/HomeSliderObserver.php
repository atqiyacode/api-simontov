<?php

namespace App\Observers\v1;

use App\Events\v1\HomeSliderEvent;
use App\Models\v1\HomeSlider;
use Illuminate\Support\Facades\Cache;

class HomeSliderObserver
{
    /**
     * Handle the HomeSlider "created" event.
     */
    public function created(HomeSlider $homeSlider): void
    {
        Cache::forget('homeSlider');
        HomeSliderEvent::dispatch('data updated');
    }

    /**
     * Handle the HomeSlider "updated" event.
     */
    public function updated(HomeSlider $homeSlider): void
    {
        Cache::forget('homeSlider');
        HomeSliderEvent::dispatch('data updated');
    }

    /**
     * Handle the HomeSlider "deleted" event.
     */
    public function deleted(HomeSlider $homeSlider): void
    {
        Cache::forget('homeSlider');
        HomeSliderEvent::dispatch('data updated');
    }
}
