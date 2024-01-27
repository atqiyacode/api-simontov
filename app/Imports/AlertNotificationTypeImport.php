<?php

namespace App\Imports;

use App\Models\AlertNotificationType;
use Maatwebsite\Excel\Concerns\ToModel;

class AlertNotificationTypeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AlertNotificationType([
            //
        ]);
    }
}
