<?php

namespace App\Imports;

use App\Models\RangeType;
use Maatwebsite\Excel\Concerns\ToModel;

class RangeTypeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new RangeType([
            //
        ]);
    }
}
