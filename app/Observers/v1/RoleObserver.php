<?php

namespace App\Observers\v1;

use App\Events\v1\RoleEvent;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Role;

class RoleObserver
{
    /**
     * Handle the Role "created" event.
     */
    public function created(Role $role): void
    {
        RoleEvent::dispatch('Role Event Created');
    }

    /**
     * Handle the Role "updated" event.
     */
    public function updated(Role $role): void
    {
        RoleEvent::dispatch('Role Event Updated');
    }

    /**
     * Handle the Role "deleted" event.
     */
    public function deleted(Role $role): void
    {
        RoleEvent::dispatch('Role Event Deleted');
    }

    /**
     * Handle the Role "restored" event.
     */
    public function restored(Role $role): void
    {
        RoleEvent::dispatch('Role Event Restored');
    }

    /**
     * Handle the Role "force deleted" event.
     */
    public function forceDeleted(Role $role): void
    {
        RoleEvent::dispatch('Role Event Delete Permanent');
    }
}
