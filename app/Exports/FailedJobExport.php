<?php

namespace App\Exports;

use App\Models\FailedJob;
use Maatwebsite\Excel\Concerns\FromCollection;

class FailedJobExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return FailedJob::all();
    }
}
