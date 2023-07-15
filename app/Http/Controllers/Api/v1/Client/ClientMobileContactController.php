<?php

namespace App\Http\Controllers\Api\v1\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Client\ClientContactResource;
use App\Models\v1\Employee;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ClientMobileContactController extends Controller
{
    use ApiResponseHelpers;

    public function index(Request $request)
    {
        $keyword = $request->search;

        $employee = Cache::remember('employeeContact' . auth()->user()->username, 60 * 5, function () {
            return Employee::currentUser()
                ->firstOrFail();
        });

        $query = Employee::where('department_id', $employee->department_id)
            ->where('code', '!=', auth()->user()->username)
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('full_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('code', 'LIKE', "%{$keyword}%");
            })
            ->orderBy('full_name', 'ASC')
            ->paginate();

        $data = ClientContactResource::collection($query);
        return $data;
    }
}
