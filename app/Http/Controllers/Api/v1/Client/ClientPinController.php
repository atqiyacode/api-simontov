<?php

namespace App\Http\Controllers\Api\v1\Client;

use App\Events\v1\UserClientEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Client\DeletePinRequest;
use App\Http\Requests\v1\Client\StorePinRequest;
use App\Http\Requests\v1\Client\UpdatePinRequest;
use App\Http\Requests\v1\Login\CheckUserPinRequest;
use App\Http\Resources\v1\Client\ClientCurrentResource;
use App\Jobs\v1\LockClientPinJob;
use F9Web\ApiResponseHelpers;
use Illuminate\Support\Facades\Hash;

class ClientPinController extends Controller
{
    use ApiResponseHelpers;

    public function index(CheckUserPinRequest $request)
    {
        $user = auth()->user();
        if (!Hash::check($request->pin, $user->pin)) {
            return response()->json([
                'title' => trans('auth.wrong_pin'),
                'message' => trans('auth.wrong_pin'),
                'errors' => [
                    'pin' => [trans('auth.wrong_pin')]
                ],
            ], 422);
        } else {
            LockClientPinJob::dispatch($user)->delay(now()->addMinute(config('app.delay_pin')));
        }
        return $this->respondOk(trans('alert.success'));
    }

    public function store(StorePinRequest $request)
    {
        $user = auth()->user();
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'title' => trans('auth.password'),
                'message' => trans('auth.password'),
                'errors' => [
                    'password' => [trans('auth.password')]
                ],
            ], 422);
        }

        $user->update([
            'pin' => Hash::make($request->pin)
        ]);

        $data = new ClientCurrentResource($user);
        UserClientEvent::dispatch($user->id, $data);
        return $this->respondWithSuccess($data);
    }

    public function update(UpdatePinRequest $request)
    {
        $user = auth()->user();
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'title' => trans('auth.password'),
                'message' => trans('auth.password'),
                'errors' => [
                    'password' => [trans('auth.password')]
                ],
            ], 422);
        }

        $user->update([
            'pin' => Hash::make($request->pin)
        ]);

        $data = new ClientCurrentResource($user);
        UserClientEvent::dispatch($user->id, $data);
        return $this->respondWithSuccess($data);
    }

    public function delete(DeletePinRequest $request)
    {
        $user = auth()->user();
        if (!Hash::check($request->pin, $user->pin)) {
            return response()->json([
                'title' => trans('auth.wrong_pin'),
                'message' => trans('auth.wrong_pin'),
                'errors' => [
                    'pin' => [trans('auth.wrong_pin')]
                ],
            ], 422);
        }
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'title' => trans('auth.password'),
                'message' => trans('auth.password'),
                'errors' => [
                    'password' => [trans('auth.password')]
                ],
            ], 422);
        }

        $user->update([
            'pin' => null
        ]);

        $data = new ClientCurrentResource($user);
        UserClientEvent::dispatch($user->id, $data);
        return $this->respondWithSuccess($data);
    }
}
