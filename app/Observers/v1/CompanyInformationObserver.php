<?php

namespace App\Observers\v1;

use App\Events\v1\CompanyInformationEvent;
use App\Models\v1\CompanyInformation;
use Illuminate\Support\Facades\Cache;

class CompanyInformationObserver
{
    /**
     * Handle the CompanyInformation "created" event.
     */
    public function created(CompanyInformation $companyInformation): void
    {
        Cache::forget('companyInformation');
        CompanyInformationEvent::dispatch('data updated');
    }

    /**
     * Handle the CompanyInformation "updated" event.
     */
    public function updated(CompanyInformation $companyInformation): void
    {
        Cache::forget('companyInformation');
        CompanyInformationEvent::dispatch('data updated');
    }

    /**
     * Handle the CompanyInformation "deleted" event.
     */
    public function deleted(CompanyInformation $companyInformation): void
    {
        Cache::forget('companyInformation');
        CompanyInformationEvent::dispatch('data updated');
    }
}
