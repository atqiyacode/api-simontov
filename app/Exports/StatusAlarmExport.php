<?php

namespace App\Exports;

use App\Models\StatusAlarm;
use Maatwebsite\Excel\Concerns\FromCollection;

class StatusAlarmExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return StatusAlarm::all();
    }
}
