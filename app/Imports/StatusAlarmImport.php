<?php

namespace App\Imports;

use App\Models\StatusAlarm;
use Maatwebsite\Excel\Concerns\ToModel;

class StatusAlarmImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new StatusAlarm([
            //
        ]);
    }
}
