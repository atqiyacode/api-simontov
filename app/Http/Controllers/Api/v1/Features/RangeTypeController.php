<?php

namespace App\Http\Controllers\Api\v1\Features;

use App\Events\v1\RangeTypeEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\RangeType\StoreRangeTypeRequest;
use App\Http\Requests\v1\RangeType\UpdateRangeTypeRequest;
use App\Http\Resources\v1\RangeTypeResource;
use App\Models\v1\RangeType;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RangeTypeController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = RangeType::canDelete()->when($request->has('search'), function ($query) use ($keyword) {
            $query->where('lower_limit', 'LIKE', "%{$keyword}%")
                ->where('upper_limit', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = RangeTypeResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRangeTypeRequest $request)
    {
        $data = DB::transaction(function () use ($request) {
            $query = RangeType::create($request->all());
            RangeTypeEvent::dispatch([
                "message" => 'Add New RangeType',
                "user" => auth()->user()->name
            ]);
            return new RangeTypeResource($query);
        });
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(RangeType $rangeType)
    {
        return $this->respondWithSuccess([
            'data' => new RangeTypeResource($rangeType)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRangeTypeRequest $request, RangeType $rangeType)
    {
        $rangeType->update($request->all());
        $data = new RangeTypeResource($rangeType);
        RangeTypeEvent::dispatch([
            "message" => 'Update RangeType',
            "user" => auth()->user()->name
        ]);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-update'),
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RangeType $rangeType)
    {
        $rangeType->delete();
        RangeTypeEvent::dispatch([
            "message" => 'Delete RangeType',
            "user" => auth()->user()->name
        ]);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }

    public function restore($id)
    {
        $rangeType = RangeType::onlyTrashed()->whereId($id)->firstOrFail();
        $data = DB::transaction(function () use ($rangeType) {
            $rangeType->restore();
            return new RangeTypeResource($rangeType);
        });
        RangeTypeEvent::dispatch($data);
        return response()->json([
            'message' => trans('alert.success-restored'),
        ], 200);
    }

    public function delete($id)
    {
        $rangeType = RangeType::onlyTrashed()->whereId($id)->firstOrFail();
        DB::transaction(function () use ($rangeType) {
            $data = new RangeTypeResource($rangeType);
            RangeTypeEvent::dispatch($data);
            $rangeType->forceDelete();
        });
        return response()->json([
            'message' => trans('alert.success-deleted-permanent'),
        ], 200);
    }
}
