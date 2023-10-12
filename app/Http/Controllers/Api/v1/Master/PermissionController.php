<?php

namespace App\Http\Controllers\Api\v1\Master;

use App\Events\v1\PermissionEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Permission\StorePermissionRequest;
use App\Http\Requests\v1\Permission\UpdatePermissionRequest;
use App\Http\Resources\v1\PermissionResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = Permission::when($request->has('search'), function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('guard_name', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = PermissionResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        $query = Permission::create($request->all());
        $data = new PermissionResource($query);
        PermissionEvent::dispatch([
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
    public function show(Permission $permission)
    {
        return $this->respondWithSuccess([
            'data' => new PermissionResource($permission)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->all());
        $data = new PermissionResource($permission);
        PermissionEvent::dispatch([
            "message" => 'Update Permission',
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
    public function destroy(Permission $permission)
    {
        $permission->delete();
        PermissionEvent::dispatch([
            "message" => 'Update Permission',
            "user" => auth()->user()->name
        ]);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }
}
