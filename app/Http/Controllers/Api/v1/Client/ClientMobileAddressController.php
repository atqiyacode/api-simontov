<?php

namespace App\Http\Controllers\Api\v1\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Client\UpdateAddressRequest;
use App\Models\v1\EmployeeAddress;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ClientMobileAddressController extends Controller
{
    use ApiResponseHelpers;

    public function index()
    {
        $address = EmployeeAddress::currentEmployee()->first();
        return $this->respondWithSuccess($address);
    }

    public function store(UpdateAddressRequest $request)
    {
        $currentAddress = EmployeeAddress::currentEmployee()->first();
        $address = $currentAddress ? $currentAddress : new EmployeeAddress();
        $address->rt = $request->rt;
        $address->rw = $request->rw;
        $address->detail = $request->detail;
        $address->province_code = $request->province;
        $address->city_code = $request->city;
        $address->district_code = $request->district;
        $address->village_code = $request->village;
        $address->post_code = $request->post_code;
        $address->employee_id = auth()->user()->employee->id;
        $address->save();

        return response()->json([
            'status' => trans('alert.success'),
            'message' => trans('alert.success'),
            'data' => $address,
        ], 200);
    }
}
