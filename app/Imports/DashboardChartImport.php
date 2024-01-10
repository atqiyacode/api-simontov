<?php

namespace App\Imports;

use App\Models\DashboardChart;
use Maatwebsite\Excel\Concerns\ToModel;

class DashboardChartImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DashboardChart([
            //
        ]);
    }
}
