<?php

namespace App\Http\Controllers\Api\v1\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\NotificationType\StoreNotificationTypeRequest;
use App\Http\Requests\v1\NotificationType\UpdateNotificationTypeRequest;
use App\Http\Resources\v1\NotificationTypeResource;
use App\Models\v1\NotificationType;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class NotificationTypeController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $status = $request->status;
        $rows = $request->rows ?? 10;
        $query = NotificationType::canDelete()
            ->when($request->has('search'), function ($query) use ($keyword) {
                return $query->where('name', 'LIKE', "%{$keyword}%");
            })
            ->when($request->has('status'), function ($query) use ($status) {
                return $query->where('status', (bool) $status);
            })
            ->orderBy('id', 'DESC');
        $data = NotificationTypeResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotificationTypeRequest $request)
    {
        $query = NotificationType::create($request->all());
        $data = new NotificationTypeResource($query);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(NotificationType $notificationType)
    {
        return $this->respondWithSuccess(new NotificationTypeResource($notificationType));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotificationTypeRequest $request, NotificationType $notificationType)
    {
        $notificationType->slug = null;
        $notificationType->update($request->all());
        $data = new NotificationTypeResource($notificationType);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-update'),
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NotificationType $notificationType)
    {
        $notificationType->delete();
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }

    public function restore($id)
    {
        NotificationType::onlyTrashed()->whereId($id)->firstOrFail()->restore();
        return response()->json([
            'message' => trans('alert.success-restored'),
        ], 200);
    }

    public function delete($id)
    {
        NotificationType::onlyTrashed()->whereId($id)->firstOrFail()->forceDelete();
        return response()->json([
            'message' => trans('alert.success-deleted-permanent'),
        ], 200);
    }
}
