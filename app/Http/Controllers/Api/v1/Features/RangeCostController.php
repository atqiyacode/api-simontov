<?php

namespace App\Http\Controllers\Api\v1\Features;

use App\Events\v1\RangeCostEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\RangeCost\StoreRangeCostRequest;
use App\Http\Requests\v1\RangeCost\UpdateRangeCostRequest;
use App\Http\Resources\v1\RangeCostResource;
use App\Models\v1\RangeCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RangeCostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = RangeCost::canDelete()->when($request->has('search'), function ($query) use ($keyword) {
            $query->where('value', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = RangeCostResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRangeCostRequest $request)
    {
        $data = DB::transaction(function () use ($request) {
            $request->merge([
                'range_type_id' => $request->type
            ]);
            $query = RangeCost::create($request->all());
            RangeCostEvent::dispatch([
                "message" => 'Add New RangeCost',
                "user" => auth()->user()->name
            ]);
            return new RangeCostResource($query);
        });
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(RangeCost $rangeCost)
    {
        return $this->respondWithSuccess([
            'data' => new RangeCostResource($rangeCost)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRangeCostRequest $request, RangeCost $rangeCost)
    {
        $request->merge([
            'range_type_id' => $request->type
        ]);
        $rangeCost->update($request->all());
        $data = new RangeCostResource($rangeCost);
        RangeCostEvent::dispatch([
            "message" => 'Update RangeCost',
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
    public function destroy(RangeCost $rangeCost)
    {
        $rangeCost->delete();
        RangeCostEvent::dispatch([
            "message" => 'Delete RangeCost',
            "user" => auth()->user()->name
        ]);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }

    public function restore($id)
    {
        $rangeCost = RangeCost::onlyTrashed()->whereId($id)->firstOrFail();
        $data = DB::transaction(function () use ($rangeCost) {
            $rangeCost->restore();
            return new RangeCostResource($rangeCost);
        });
        RangeCostEvent::dispatch($data);
        return response()->json([
            'message' => trans('alert.success-restored'),
        ], 200);
    }

    public function delete($id)
    {
        $rangeCost = RangeCost::onlyTrashed()->whereId($id)->firstOrFail();
        DB::transaction(function () use ($rangeCost) {
            $data = new RangeCostResource($rangeCost);
            RangeCostEvent::dispatch($data);
            $rangeCost->forceDelete();
        });
        return response()->json([
            'message' => trans('alert.success-deleted-permanent'),
        ], 200);
    }
}
