<?php

namespace App\Http\Controllers\Api\v1\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\PersonalNotification\StorePersonalNotificationRequest;
use App\Http\Requests\v1\PersonalNotification\UpdatePersonalNotificationRequest;
use App\Http\Resources\v1\PersonalNotificationResource;
use App\Models\v1\PersonalNotification;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class PersonalNotificationController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = PersonalNotification::canDelete()->when($request->has('search'), function ($query) use ($keyword) {
            $query->where('label', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = PersonalNotificationResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonalNotificationRequest $request)
    {
        $request->merge([
            'user_id' => auth()->user()->id,
        ]);
        $query = PersonalNotification::create($request->all());
        $data = new PersonalNotificationResource($query);

        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PersonalNotification $personalNotification)
    {
        return $this->respondWithSuccess(new PersonalNotificationResource($personalNotification));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonalNotificationRequest $request, PersonalNotification $personalNotification)
    {
        $request->merge([
            'user_id' => auth()->user()->id,
        ]);
        $personalNotification->update($request->all());
        $data = new PersonalNotificationResource($personalNotification);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-update'),
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonalNotification $personalNotification)
    {
        $personalNotification->delete();
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }

    public function restore($id)
    {
        PersonalNotification::onlyTrashed()->whereId($id)->firstOrFail()->restore();
        return response()->json([
            'message' => trans('alert.success-restored'),
        ], 200);
    }

    public function delete($id)
    {
        PersonalNotification::onlyTrashed()->whereId($id)->firstOrFail()->forceDelete();
        return response()->json([
            'message' => trans('alert.success-deleted-permanent'),
        ], 200);
    }
}
