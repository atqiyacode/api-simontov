<?php

namespace App\Http\Controllers\Api\v1\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\MobileBuildType\StoreMobileBuildTypeRequest;
use App\Http\Requests\v1\MobileBuildType\UpdateMobileBuildTypeRequest;
use App\Http\Resources\v1\MobileBuildTypeResource;
use App\Models\v1\MobileBuildType;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class MobileBuildTypeController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = MobileBuildType::when($request->has('search'), function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = MobileBuildTypeResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMobileBuildTypeRequest $request)
    {
        $query = MobileBuildType::create($request->all());
        $data = new MobileBuildTypeResource($query);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MobileBuildType $mobileBuildType)
    {
        return $this->respondWithSuccess([
            'data' => new MobileBuildTypeResource($mobileBuildType)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMobileBuildTypeRequest $request, MobileBuildType $mobileBuildType)
    {
        $mobileBuildType->slug = null;
        $mobileBuildType->update($request->all());
        $data = new MobileBuildTypeResource($mobileBuildType);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-update'),
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MobileBuildType $mobileBuildType)
    {
        $mobileBuildType->delete();
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }

    public function restore($id)
    {
        MobileBuildType::onlyTrashed()->whereId($id)->firstOrFail()->restore();
        return response()->json([
            'message' => trans('alert.success-restored'),
        ], 200);
    }

    public function delete($id)
    {
        MobileBuildType::onlyTrashed()->whereId($id)->firstOrFail()->forceDelete();
        return response()->json([
            'message' => trans('alert.success-deleted-permanent'),
        ], 200);
    }
}
