<?php

namespace App\Exports;

use App\Models\LocationNotification;
use Maatwebsite\Excel\Concerns\FromCollection;

class LocationNotificationExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LocationNotification::all();
    }
}
