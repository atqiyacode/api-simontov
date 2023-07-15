<?php

namespace App\Observers\v1;

use App\Events\v1\PermissionEvent;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;

class PermissionObserver
{
    /**
     * Handle the Permission "created" event.
     */
    public function created(Permission $permission): void
    {
        PermissionEvent::dispatch('Permission Event Created');
    }

    /**
     * Handle the Permission "updated" event.
     */
    public function updated(Permission $permission): void
    {
        PermissionEvent::dispatch('Permission Event Updated');
    }

    /**
     * Handle the Permission "deleted" event.
     */
    public function deleted(Permission $permission): void
    {
        PermissionEvent::dispatch('Permission Event Deleted');
    }

    /**
     * Handle the Permission "restored" event.
     */
    public function restored(Permission $permission): void
    {
        PermissionEvent::dispatch('Permission Event Restored');
    }

    /**
     * Handle the Permission "force deleted" event.
     */
    public function forceDeleted(Permission $permission): void
    {
        PermissionEvent::dispatch('Permission Event Delete Permanent');
    }
}
