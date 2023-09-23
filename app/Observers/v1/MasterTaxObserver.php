<?php

namespace App\Observers\v1;

use App\Models\v1\MasterTax;

class MasterTaxObserver
{
    /**
     * Handle the MasterTax "created" event.
     */
    public function created(MasterTax $masterTax): void
    {
        //
    }

    /**
     * Handle the MasterTax "updated" event.
     */
    public function updated(MasterTax $masterTax): void
    {
        //
    }

    /**
     * Handle the MasterTax "deleted" event.
     */
    public function deleted(MasterTax $masterTax): void
    {
        //
    }

    /**
     * Handle the MasterTax "restored" event.
     */
    public function restored(MasterTax $masterTax): void
    {
        //
    }

    /**
     * Handle the MasterTax "force deleted" event.
     */
    public function forceDeleted(MasterTax $masterTax): void
    {
        //
    }
}
