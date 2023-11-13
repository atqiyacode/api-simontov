<?php

namespace App\Exports;

use App\Models\RangeType;
use Maatwebsite\Excel\Concerns\FromCollection;

class RangeTypeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RangeType::all();
    }
}
