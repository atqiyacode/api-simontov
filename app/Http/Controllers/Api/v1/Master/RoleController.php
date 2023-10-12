<?php

namespace App\Http\Controllers\Api\v1\Master;

use App\Events\v1\RoleEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Role\StoreRoleRequest;
use App\Http\Requests\v1\Role\UpdateRoleRequest;
use App\Http\Resources\v1\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = Role::when($request->has('search'), function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('guard_name', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = RoleResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $data = DB::transaction(function () use ($request) {
            $query = Role::create($request->all());
            $query->givePermissionTo($request->permissions);
            RoleEvent::dispatch([
                "message" => 'Add New Role',
                "user" => auth()->user()->name
            ]);
            return new RoleResource($query);
        });
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return $this->respondWithSuccess([
            'data' => new RoleResource($role)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->all());
        $role->syncPermissions($request->permissions);
        $data = new RoleResource($role);
        RoleEvent::dispatch([
            "message" => 'Update Role',
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
    public function destroy(Role $role)
    {
        if ($role->name === 'superadmin') {
            return $this->respondError(
                trans('alert.failed')
            );
        }
        $role->delete();
        RoleEvent::dispatch([
            "message" => 'Delete Role',
            "user" => auth()->user()->name
        ]);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }
}
