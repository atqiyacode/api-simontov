<?php

namespace App\Http\Controllers\Api\v1\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PersonalNotificationUserResource;
use App\Models\v1\PersonalNotificationUser;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientMobilePersonalNotificationController extends Controller
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
        $query = PersonalNotificationUser::when($status, function ($query) use ($status) {
            $query->where('status', $status);
        })

            ->currentUser()
            ->orderBy('created_at', 'DESC');
        $data = PersonalNotificationUserResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            return PersonalNotificationUser::currentUser()
                ->notRead()
                ->update(["status" => true]);
        });
        return $this->respondOk(trans('alert.mark-all-notification'));
    }

    public function update(PersonalNotificationUser $personalNotificationUser)
    {
        DB::transaction(function () use ($personalNotificationUser) {
            $personalNotificationUser->status = true;
            return $personalNotificationUser->update();
        });
        return $this->respondOk(trans('alert.mark-notification'));
    }

    public function destroy(PersonalNotificationUser $personalNotificationUser)
    {
        DB::transaction(function () use ($personalNotificationUser) {
            $personalNotificationUser->delete();
            return $this->respondOk(trans('alert.success-deleted'));
        });
    }

    public function destroyAll()
    {
        DB::transaction(function () {
            PersonalNotificationUser::currentUser()->delete();
            return $this->respondOk(trans('alert.success-deleted'));
        });
    }

    public function countNotification()
    {
        $data = PersonalNotificationUser::notRead()
            ->currentUser()
            ->count();

        return $this->respondWithSuccess([
            'message' => trans('alert.success'),
            'data' => $data
        ]);
    }
}
