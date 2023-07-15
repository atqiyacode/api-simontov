<?php

namespace App\Http\Controllers\Api\v1\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\MobileStatus\StoreMobileStatusRequest;
use App\Http\Requests\v1\MobileStatus\UpdateMobileStatusRequest;
use App\Http\Resources\v1\MobileStatusResource;
use App\Models\v1\MobileStatus;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class MobileStatusController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = MobileStatus::when($request->has('search'), function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = MobileStatusResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMobileStatusRequest $request)
    {
        $query = MobileStatus::create($request->all());
        $data = new MobileStatusResource($query);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MobileStatus $mobileStatus)
    {
        return $this->respondWithSuccess([
            'data' => new MobileStatusResource($mobileStatus)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMobileStatusRequest $request, MobileStatus $mobileStatus)
    {
        $mobileStatus->slug = null;
        $mobileStatus->update($request->all());
        $data = new MobileStatusResource($mobileStatus);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-update'),
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MobileStatus $mobileStatus)
    {
        $mobileStatus->delete();
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }

    public function restore($id)
    {
        MobileStatus::onlyTrashed()->whereId($id)->firstOrFail()->restore();
        return response()->json([
            'message' => trans('alert.success-restored'),
        ], 200);
    }

    public function delete($id)
    {
        MobileStatus::onlyTrashed()->whereId($id)->firstOrFail()->forceDelete();
        return response()->json([
            'message' => trans('alert.success-deleted-permanent'),
        ], 200);
    }
}
