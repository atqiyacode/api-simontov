<?php

namespace App\Observers\v1;

use App\Events\v1\AuthVerificationMethodEvent;
use App\Models\v1\AuthVerificationMethod;
use Illuminate\Support\Facades\Cache;

class AuthVerificationMethodObserver
{
    /**
     * Handle the AuthVerificationMethod "created" event.
     */
    public function created(AuthVerificationMethod $authVerificationMethod): void
    {
        Cache::forget('authVerificationMethod');
        AuthVerificationMethodEvent::dispatch('authVerificationMethod Updated');
    }

    /**
     * Handle the AuthVerificationMethod "updated" event.
     */
    public function updated(AuthVerificationMethod $authVerificationMethod): void
    {
        Cache::forget('authVerificationMethod');
        AuthVerificationMethodEvent::dispatch('authVerificationMethod Updated');
    }

    /**
     * Handle the AuthVerificationMethod "deleted" event.
     */
    public function deleted(AuthVerificationMethod $authVerificationMethod): void
    {
        Cache::forget('authVerificationMethod');
        AuthVerificationMethodEvent::dispatch('authVerificationMethod Updated');
    }

    /**
     * Handle the AuthVerificationMethod "restored" event.
     */
    public function restored(AuthVerificationMethod $authVerificationMethod): void
    {
        Cache::forget('authVerificationMethod');
        AuthVerificationMethodEvent::dispatch('authVerificationMethod Updated');
    }

    /**
     * Handle the AuthVerificationMethod "force deleted" event.
     */
    public function forceDeleted(AuthVerificationMethod $authVerificationMethod): void
    {
        Cache::forget('authVerificationMethod');
        AuthVerificationMethodEvent::dispatch('authVerificationMethod Updated');
    }
}
