<?php

namespace App\Exports;

use App\Models\AlertNotificationType;
use Maatwebsite\Excel\Concerns\FromCollection;

class AlertNotificationTypeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AlertNotificationType::all();
    }
}
