<?php

namespace App\Http\Controllers\Api\v1\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\GlobalNotificationUser\StoreGlobalNotificationUserRequest;
use App\Http\Requests\v1\GlobalNotificationUser\UpdateGlobalNotificationUserRequest;
use App\Http\Resources\v1\GlobalNotificationUserResource;
use App\Models\v1\GlobalNotificationUser;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class GlobalNotificationUserController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = GlobalNotificationUser::when($request->has('search'), function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = GlobalNotificationUserResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGlobalNotificationUserRequest $request)
    {
        $query = GlobalNotificationUser::create($request->all());
        $data = new GlobalNotificationUserResource($query);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(GlobalNotificationUser $globalNotificationUser)
    {
        return $this->respondWithSuccess([
            'data' => new GlobalNotificationUserResource($globalNotificationUser)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGlobalNotificationUserRequest $request, GlobalNotificationUser $globalNotificationUser)
    {
        $globalNotificationUser->update($request->all());
        $data = new GlobalNotificationUserResource($globalNotificationUser);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-update'),
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GlobalNotificationUser $globalNotificationUser)
    {
        $globalNotificationUser->delete();
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }
}
