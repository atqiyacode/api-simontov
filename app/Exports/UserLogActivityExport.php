<?php

namespace App\Exports;

use App\Models\UserLogActivity;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserLogActivityExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserLogActivity::all();
    }
}
