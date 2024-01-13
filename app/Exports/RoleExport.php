<?php

namespace App\Exports;

use App\Models\Role;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RoleExport implements FromView
{
    public function view(): View
    {
        $data = Role::select([
            'id', 'name', 'guard_name'
        ])->get();
        return view('exports.roles', [
            'data' => $data
        ]);
    }
}
