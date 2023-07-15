<?php

namespace App\Http\Controllers\Api\v1\Master;

use App\Events\v1\UserEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\User\StoreUserRequest;
use App\Http\Requests\v1\User\UpdateUserRequest;
use App\Http\Resources\v1\UserResource;
use App\Http\Resources\v1\UserSimpleResource;
use App\Models\User;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleHttpRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

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
                    ->orWhere('username', 'LIKE', "%{$keyword}%")
                    ->orWhere('phone', 'LIKE', "%{$keyword}%");
            })
            ->when($request->has('sort'), function ($query) use ($sort, $position) {
                $query->orderBy($sort, $position);
            })
            ->canDelete()
            ->private()
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
        $this->checkWhatsappNumber($request->phone);
        $user = DB::transaction(function () use ($request) {
            $request->merge([
                'pin' => Hash::make($request->pin),
            ]);
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
        $this->checkWhatsappNumber($request->phone);
        $user = DB::transaction(function () use ($request, $user) {
            $request->merge([
                'email' => $request->email ? $request->email : $user->email,
                'pin' => $request->pin ? Hash::make($request->pin) : $user->pin,
            ]);
            $user->update($request->all());
            $user->syncRoles($request->roles);
            $user->syncPermissions($request->permissions);
            return $user;
        });
        $data = new UserResource($user);
        // send event
        UserEvent::dispatch($data);
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

    private function checkWhatsappNumber($phone)
    {
        if (app()->isProduction()) {
            $url = config('app.whatsapp_server_main') . '/contacts/' . $phone;
            $client = new Client();
            $req = new GuzzleHttpRequest('GET', $url);
            $res = $client->sendAsync($req)->wait();
            $status = json_decode($res->getBody(), true);
            if (!$status['exists']) {
                return response()->json([
                    'title' => trans('alert.not_whatsapp_number'),
                    'message' => trans('alert.not_whatsapp_number'),
                    'errors' => [
                        'phone' => [trans('alert.not_whatsapp_number')]
                    ],
                ], 422);
            }
        }
    }

    public function simple()
    {
        $data = Cache::remember('user-options', config('app.cache_time'), function () {
            $query = User::select(['id', 'name'])->get();
            return UserSimpleResource::collection($query);
        });

        return $data;
    }
}
