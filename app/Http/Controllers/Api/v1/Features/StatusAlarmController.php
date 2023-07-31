<?php

namespace App\Http\Controllers\Api\v1\Features;

use App\Events\v1\StatusAlarmEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StatusAlarm\StoreStatusAlarmRequest;
use App\Http\Requests\v1\StatusAlarm\UpdateStatusAlarmRequest;
use App\Http\Resources\v1\StatusAlarmResource;
use App\Models\v1\StatusAlarm;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusAlarmController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = StatusAlarm::canDelete()->when($request->has('search'), function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = StatusAlarmResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStatusAlarmRequest $request)
    {
        $data = DB::transaction(function () use ($request) {
            $query = StatusAlarm::create($request->all());
            StatusAlarmEvent::dispatch([
                "message" => 'Add New StatusAlarm',
                "user" => auth()->user()->name
            ]);
            return new StatusAlarmResource($query);
        });
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(StatusAlarm $statusAlarm)
    {
        return $this->respondWithSuccess([
            'data' => new StatusAlarmResource($statusAlarm)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatusAlarmRequest $request, StatusAlarm $statusAlarm)
    {
        $statusAlarm->update($request->all());
        $data = new StatusAlarmResource($statusAlarm);
        StatusAlarmEvent::dispatch([
            "message" => 'Update StatusAlarm',
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
    public function destroy(StatusAlarm $statusAlarm)
    {
        $statusAlarm->delete();
        StatusAlarmEvent::dispatch([
            "message" => 'Delete StatusAlarm',
            "user" => auth()->user()->name
        ]);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }

    public function restore($id)
    {
        $statusAlarm = StatusAlarm::onlyTrashed()->whereId($id)->firstOrFail();
        $data = DB::transaction(function () use ($statusAlarm) {
            $statusAlarm->restore();
            return new StatusAlarmResource($statusAlarm);
        });
        StatusAlarmEvent::dispatch($data);
        return response()->json([
            'message' => trans('alert.success-restored'),
        ], 200);
    }

    public function delete($id)
    {
        $statusAlarm = StatusAlarm::onlyTrashed()->whereId($id)->firstOrFail();
        DB::transaction(function () use ($statusAlarm) {
            $data = new StatusAlarmResource($statusAlarm);
            StatusAlarmEvent::dispatch($data);
            $statusAlarm->forceDelete();
        });
        return response()->json([
            'message' => trans('alert.success-deleted-permanent'),
        ], 200);
    }
}
