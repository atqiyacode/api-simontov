<?php

namespace App\Http\Controllers\Api\v1\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\GlobalNotification\StoreGlobalNotificationRequest;
use App\Http\Requests\v1\GlobalNotification\UpdateGlobalNotificationRequest;
use App\Http\Resources\v1\GlobalNotificationResource;
use App\Models\User;
use App\Models\v1\GlobalNotification;
use App\Models\v1\GlobalNotificationUser;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class GlobalNotificationController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = GlobalNotification::canDelete()->when($request->has('search'), function ($query) use ($keyword) {
            $query->where('label', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = GlobalNotificationResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGlobalNotificationRequest $request)
    {
        $request->merge([
            'user_id' => auth()->user()->id,
            'notification_type_id' => $request->type
        ]);
        $query = GlobalNotification::create($request->all());
        $data = new GlobalNotificationResource($query);

        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(GlobalNotification $globalNotification)
    {
        return $this->respondWithSuccess(new GlobalNotificationResource($globalNotification));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGlobalNotificationRequest $request, GlobalNotification $globalNotification)
    {
        $request->merge([
            'user_id' => auth()->user()->id,
            'notification_type_id' => $request->type
        ]);
        $globalNotification->update($request->all());
        $data = new GlobalNotificationResource($globalNotification);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-update'),
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GlobalNotification $globalNotification)
    {
        $globalNotification->delete();
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }

    public function restore($id)
    {
        GlobalNotification::onlyTrashed()->whereId($id)->firstOrFail()->restore();
        return response()->json([
            'message' => trans('alert.success-restored'),
        ], 200);
    }

    public function delete($id)
    {
        GlobalNotification::onlyTrashed()->whereId($id)->firstOrFail()->forceDelete();
        return response()->json([
            'message' => trans('alert.success-deleted-permanent'),
        ], 200);
    }
}
