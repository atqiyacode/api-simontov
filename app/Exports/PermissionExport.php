<?php

namespace App\Exports;

use App\Models\Permission;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PermissionExport implements FromView
{
    public function view(): View
    {
        $data = Permission::select([
            'id', 'name', 'guard_name'
        ])->get();
        return view('exports.permissions', [
            'data' => $data
        ]);
    }
}
