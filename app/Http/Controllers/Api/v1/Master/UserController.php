<?php

namespace App\Http\Controllers\Api\v1\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\User\StoreUserRequest;
use App\Http\Requests\v1\User\UpdateUserRequest;
use App\Http\Resources\v1\UserResource;
use App\Models\User;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->sortField ?? 'id';
        $position = $request->sortOrder ?? 'DESC';
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = User::with(['roles'])
            ->when($request->has('status'), function ($query) use ($request) {
                if ($request->status == 'true') {
                    $query->verified();
                } elseif ($request->status == 'false') {
                    $query->notVerified();
                }
            })
            ->when($request->has('search'), function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('phone', 'LIKE', "%{$keyword}%")
                    ->orWhere('phone', 'LIKE', "%{$keyword}%");
            })
            ->when($request->has('sort'), function ($query) use ($sort, $position) {
                $query->orderBy($sort, $position);
            })
            ->canDelete()
            ->notCurrent()
            ->orderBy('id', 'DESC');
        $data = UserResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = DB::transaction(function () use ($request) {
            $user = User::create($request->all());
            $user->assignRole($request->roles);
            $user->givePermissionTo($request->permissions);

            return $user;
        });
        $data = new UserResource($user);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->respondWithSuccess([
            'data' => new UserResource($user)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user = DB::transaction(function () use ($request, $user) {
            $request->email != $user->email ? $user->newEmail($request->email) : null;
            $request->merge([
                'email' => $user->email,
                'password' => $request->password ? $request->password : $user->password
            ]);
            $user->update($request->all());
            $user->syncRoles($request->roles);
            $user->syncPermissions($request->permissions);
            return $user;
        });
        $data = new UserResource($user);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-update'),
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }

    public function restore($id)
    {
        User::onlyTrashed()->whereId($id)->firstOrFail()->restore();
        return response()->json([
            'message' => trans('alert.success-restored'),
        ], 200);
    }

    public function delete($id)
    {
        User::onlyTrashed()->whereId($id)->firstOrFail()->forceDelete();
        return response()->json([
            'message' => trans('alert.success-deleted-permanent'),
        ], 200);
    }

    public function resendPendingEmailVerificationMail($id)
    {
        User::whereId($id)->firstOrFail()->resendPendingEmailVerificationMail();
        return response()->json([
            'message' => trans('alert.success'),
        ], 200);
    }

    public function clearPendingEmail($id)
    {
        User::whereId($id)->firstOrFail()->clearPendingEmail();
        return response()->json([
            'message' => trans('alert.success'),
        ], 200);
    }
}
