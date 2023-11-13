<?php

namespace App\Exports;

use App\Models\RangeCost;
use Maatwebsite\Excel\Concerns\FromCollection;

class RangeCostExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RangeCost::all();
    }
}
