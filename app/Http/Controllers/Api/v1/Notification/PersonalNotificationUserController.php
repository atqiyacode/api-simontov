<?php

namespace App\Http\Controllers\Api\v1\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\PersonalNotificationUser\StorePersonalNotificationUserRequest;
use App\Http\Requests\v1\PersonalNotificationUser\UpdatePersonalNotificationUserRequest;
use App\Http\Resources\v1\PersonalNotificationUserResource;
use App\Models\v1\PersonalNotificationUser;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class PersonalNotificationUserController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = PersonalNotificationUser::when($request->has('search'), function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = PersonalNotificationUserResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonalNotificationUserRequest $request)
    {
        $query = PersonalNotificationUser::create($request->all());
        $data = new PersonalNotificationUserResource($query);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PersonalNotificationUser $personalNotificationUser)
    {
        return $this->respondWithSuccess([
            'data' => new PersonalNotificationUserResource($personalNotificationUser)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonalNotificationUserRequest $request, PersonalNotificationUser $personalNotificationUser)
    {
        $personalNotificationUser->update($request->all());
        $data = new PersonalNotificationUserResource($personalNotificationUser);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-update'),
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonalNotificationUser $personalNotificationUser)
    {
        $personalNotificationUser->delete();
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }
}
