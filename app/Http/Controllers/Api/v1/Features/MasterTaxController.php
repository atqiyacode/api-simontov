<?php

namespace App\Http\Controllers\Api\v1\Features;

use App\Events\v1\MasterTaxEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\MasterTax\StoreMasterTaxRequest;
use App\Http\Requests\v1\MasterTax\UpdateMasterTaxRequest;
use App\Http\Resources\v1\MasterTaxResource;
use App\Models\v1\MasterTax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterTaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = MasterTax::canDelete()->when($request->has('search'), function ($query) use ($keyword) {
            $query->where('value', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = MasterTaxResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMasterTaxRequest $request)
    {
        $data = DB::transaction(function () use ($request) {
            $query = MasterTax::create($request->all());
            MasterTaxEvent::dispatch([
                "message" => 'Add New MasterTax',
                "user" => auth()->user()->name
            ]);
            return new MasterTaxResource($query);
        });
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MasterTax $masterTax)
    {
        return $this->respondWithSuccess([
            'data' => new MasterTaxResource($masterTax)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMasterTaxRequest $request, MasterTax $masterTax)
    {
        $masterTax->update($request->all());
        $data = new MasterTaxResource($masterTax);
        MasterTaxEvent::dispatch([
            "message" => 'Update MasterTax',
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
    public function destroy(MasterTax $masterTax)
    {
        $masterTax->delete();
        MasterTaxEvent::dispatch([
            "message" => 'Delete MasterTax',
            "user" => auth()->user()->name
        ]);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }

    public function restore($id)
    {
        $masterTax = MasterTax::onlyTrashed()->whereId($id)->firstOrFail();
        $data = DB::transaction(function () use ($masterTax) {
            $masterTax->restore();
            return new MasterTaxResource($masterTax);
        });
        MasterTaxEvent::dispatch($data);
        return response()->json([
            'message' => trans('alert.success-restored'),
        ], 200);
    }

    public function delete($id)
    {
        $masterTax = MasterTax::onlyTrashed()->whereId($id)->firstOrFail();
        DB::transaction(function () use ($masterTax) {
            $data = new MasterTaxResource($masterTax);
            MasterTaxEvent::dispatch($data);
            $masterTax->forceDelete();
        });
        return response()->json([
            'message' => trans('alert.success-deleted-permanent'),
        ], 200);
    }
}
