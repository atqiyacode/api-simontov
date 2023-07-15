<?php

namespace App\Http\Controllers\Api\v1\Info;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\DeveloperNote\StoreDeveloperNoteRequest;
use App\Http\Requests\v1\DeveloperNote\UpdateDeveloperNoteRequest;
use App\Http\Resources\v1\DeveloperNoteResource;
use App\Models\v1\DeveloperNote;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class DeveloperNoteController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = DeveloperNote::when($request->has('search'), function ($query) use ($keyword) {
            $query->where('label', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = DeveloperNoteResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeveloperNoteRequest $request)
    {
        $query = DeveloperNote::create($request->all());
        $data = new DeveloperNoteResource($query);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(DeveloperNote $developerNote)
    {
        return $this->respondWithSuccess([
            'data' => new DeveloperNoteResource($developerNote)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeveloperNoteRequest $request, DeveloperNote $developerNote)
    {
        $developerNote->slug = null;
        $developerNote->update($request->all());
        $data = new DeveloperNoteResource($developerNote);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-update'),
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeveloperNote $developerNote)
    {
        $developerNote->delete();
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }

    public function restore($id)
    {
        DeveloperNote::onlyTrashed()->whereId($id)->firstOrFail()->restore();
        return response()->json([
            'message' => trans('alert.success-restored'),
        ], 200);
    }

    public function delete($id)
    {
        DeveloperNote::onlyTrashed()->whereId($id)->firstOrFail()->forceDelete();
        return response()->json([
            'message' => trans('alert.success-deleted-permanent'),
        ], 200);
    }
}
