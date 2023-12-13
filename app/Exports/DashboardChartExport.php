<?php

namespace App\Exports;

use App\Models\DashboardChart;
use Maatwebsite\Excel\Concerns\FromCollection;

class DashboardChartExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DashboardChart::all();
    }
}
