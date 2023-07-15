<?php

namespace App\Http\Controllers\Api\v1\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\MobileDeviceType\StoreMobileDeviceTypeRequest;
use App\Http\Requests\v1\MobileDeviceType\UpdateMobileDeviceTypeRequest;
use App\Http\Resources\v1\MobileDeviceTypeResource;
use App\Models\v1\MobileDeviceType;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class MobileDeviceTypeController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = MobileDeviceType::when($request->has('search'), function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = MobileDeviceTypeResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMobileDeviceTypeRequest $request)
    {
        $query = MobileDeviceType::create($request->all());
        $data = new MobileDeviceTypeResource($query);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MobileDeviceType $mobileDeviceType)
    {
        return $this->respondWithSuccess([
            'data' => new MobileDeviceTypeResource($mobileDeviceType)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMobileDeviceTypeRequest $request, MobileDeviceType $mobileDeviceType)
    {
        $mobileDeviceType->slug = null;
        $mobileDeviceType->update($request->all());
        $data = new MobileDeviceTypeResource($mobileDeviceType);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-update'),
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MobileDeviceType $mobileDeviceType)
    {
        $mobileDeviceType->delete();
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }

    public function restore($id)
    {
        MobileDeviceType::onlyTrashed()->whereId($id)->firstOrFail()->restore();
        return response()->json([
            'message' => trans('alert.success-restored'),
        ], 200);
    }

    public function delete($id)
    {
        MobileDeviceType::onlyTrashed()->whereId($id)->firstOrFail()->forceDelete();
        return response()->json([
            'message' => trans('alert.success-deleted-permanent'),
        ], 200);
    }
}
