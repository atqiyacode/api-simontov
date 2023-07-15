<?php

namespace App\Http\Controllers\Api\v1\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\MobileAppServerStatus\UpdateMobileAppServerStatusRequest;
use App\Http\Resources\v1\MobileAppServerStatusResource;
use App\Models\v1\MobileAppServerStatus;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MobileAppServerStatusController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rows = $request->rows ?? 10;
        $query = MobileAppServerStatus::orderBy('id', 'DESC');
        $data = MobileAppServerStatusResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(MobileAppServerStatus $mobileAppServerStatus)
    {
        return $this->respondWithSuccess([
            'data' => new MobileAppServerStatusResource($mobileAppServerStatus)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMobileAppServerStatusRequest $request, MobileAppServerStatus $mobileAppServerStatus)
    {
        $data = DB::transaction(function () use ($request, $mobileAppServerStatus) {
            $mobileAppServerStatus->update($request->all());
            return new MobileAppServerStatusResource($mobileAppServerStatus);
        });
        return $this->respondWithSuccess([
            'message' => trans('alert.success-update'),
            'data' => $data
        ]);
    }
}
