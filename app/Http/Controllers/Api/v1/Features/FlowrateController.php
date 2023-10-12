<?php

namespace App\Http\Controllers\Api\v1\Features;

use App\Events\v1\FlowrateEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Flowrate\StoreFlowrateRequest;
use App\Http\Requests\v1\Flowrate\UpdateFlowrateRequest;
use App\Http\Resources\v1\FlowrateResource;
use App\Models\v1\Flowrate;
use Illuminate\Http\Request;

class FlowrateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = Flowrate::canDelete()->when($request->has('search'), function ($query) use ($keyword) {
            $query->where('mag_date_time', 'LIKE', "%{$keyword}%")
                ->orWhere('flowrate', 'LIKE', "%{$keyword}%")
                ->orWhere('totalizer_1', 'LIKE', "%{$keyword}%")
                ->orWhere('totalizer_2', 'LIKE', "%{$keyword}%")
                ->orWhere('totalizer_3', 'LIKE', "%{$keyword}%")
                ->orWhere('analog_1', 'LIKE', "%{$keyword}%")
                ->orWhere('analog_2', 'LIKE', "%{$keyword}%")
                ->orWhere('status_battery', 'LIKE', "%{$keyword}%")
                ->orWhere('alarm', 'LIKE', "%{$keyword}%")
                ->orWhere('bin_alarm', 'LIKE', "%{$keyword}%")
                ->orWhere('file_name', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = FlowrateResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFlowrateRequest $request)
    {
        $query = Flowrate::create($request->all());
        $data = new FlowrateResource($query);
        FlowrateEvent::dispatch([
            "message" => 'New Role',
            "user" => auth()->user()->name
        ]);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Flowrate $flowrate)
    {
        return $this->respondWithSuccess([
            'data' => new FlowrateResource($flowrate)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFlowrateRequest $request, Flowrate $flowrate)
    {
        $flowrate->update($request->all());
        $data = new FlowrateResource($flowrate);
        FlowrateEvent::dispatch([
            "message" => 'Update Flowrate',
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
    public function destroy(Flowrate $flowrate)
    {
        $flowrate->delete();
        FlowrateEvent::dispatch([
            "message" => 'Update Flowrate',
            "user" => auth()->user()->name
        ]);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }

    public function restore($id)
    {
        Flowrate::onlyTrashed()->whereId($id)->firstOrFail()->restore();
        return response()->json([
            'message' => trans('alert.success-restored'),
        ], 200);
    }

    public function delete($id)
    {
        Flowrate::onlyTrashed()->whereId($id)->firstOrFail()->forceDelete();
        return response()->json([
            'message' => trans('alert.success-deleted-permanent'),
        ], 200);
    }
}
