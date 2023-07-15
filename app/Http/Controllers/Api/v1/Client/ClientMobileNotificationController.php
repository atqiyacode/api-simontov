<?php

namespace App\Http\Controllers\Api\v1\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\GlobalNotificationUserResource;
use App\Models\v1\GlobalNotificationUser;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientMobileNotificationController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->status;
        $keyword = $request->search;
        $rows = $request->rows ?? 20;
        $query = GlobalNotificationUser::when($status, function ($query) use ($status) {
            $query->where('status', $status);
        })
            ->whereHas('notification', function ($query) use ($keyword) {
                $query->where('label', 'LIKE', "%{$keyword}%")
                    ->orWhere('message', 'LIKE', "%{$keyword}%");
            })
            ->currentUser()
            ->orderBy('created_at', 'DESC');
        $data = GlobalNotificationUserResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            return GlobalNotificationUser::currentUser()
                ->notRead()
                ->update(["status" => true]);
        });
        return $this->respondOk(trans('alert.mark-all-notification'));
    }

    public function update(GlobalNotificationUser $notification)
    {
        DB::transaction(function () use ($notification) {
            $notification->status = true;
            return $notification->update();
        });
        return $this->respondOk(trans('alert.mark-notification'));
    }

    public function destroy(GlobalNotificationUser $notification)
    {
        DB::transaction(function () use ($notification) {
            $notification->delete();
            return $this->respondOk(trans('alert.success-deleted'));
        });
    }

    public function destroyAll()
    {
        DB::transaction(function () {
            GlobalNotificationUser::currentUser()->delete();
            return $this->respondOk(trans('alert.success-deleted'));
        });
    }

    public function countNotification()
    {
        $data = GlobalNotificationUser::notRead()
            ->currentUser()
            ->count();

        return $this->respondWithSuccess([
            'message' => trans('alert.success'),
            'data' => $data
        ]);
    }
}
