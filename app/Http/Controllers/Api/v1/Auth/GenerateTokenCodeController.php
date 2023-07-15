<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Auth\GenerateTokenCodeRequest;
use App\Jobs\v1\AlertLoginNotificationjob;
use App\Jobs\v1\SendEmailLoginNotificationJob;
use App\Jobs\v1\SendWhatsappLoginNotificationJob;
use App\Models\User;
use App\Models\v1\UserVerificationCode;
use App\Models\v1\VerificationCodeType;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Browser;

class GenerateTokenCodeController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index(GenerateTokenCodeRequest $request)
    {
        $user = User::withTrashed()->with(['firebaseToken'])->where('username', $request->username)
            ->firstOrFail();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'title' => trans('auth.password'),
                'message' => trans('auth.password'),
                'errors' => [
                    'password' => [trans('auth.password')],
                ],
            ], 422);
        }

        if ($user->deleted_at) {
            return response()->json([
                'title' => trans('auth.deleted_user'),
                'message' => trans('auth.deleted_user'),
                'errors' => [
                    'username' => [trans('auth.deleted_user')]
                ],
            ]);
        }

        if ($request->method === 'whatsapp' && $user->phone === null) {
            return response()->json([
                'title' => trans('alert.account_no_whatsapp_number'),
                'message' => trans('alert.account_no_whatsapp_number'),
                'errors' => [
                    'username' => [trans('alert.account_no_whatsapp_number')]
                ],
            ]);
        }

        if ($request->method === 'email' && $user->email === null) {
            return response()->json([
                'title' => trans('alert.account_no_email'),
                'message' => trans('alert.account_no_email'),
                'errors' => [
                    'username' => [trans('alert.account_no_email')]
                ],
            ]);
        }

        if ($request->method === 'device' && $user->firebaseToken === null) {
            return response()->json([
                'title' => trans('alert.account_no_device'),
                'message' => trans('alert.account_no_device'),
                'errors' => [
                    'username' => [trans('alert.account_no_device')]
                ],
            ]);
        }

        $code = config('app.random_otp') ? rand(100000, 999999) : '111111';
        $expired_at = now()->addMinutes(config('app.expired_otp'));

        if ($user->username === '10000') {
            $code = '111111';
        }

        DB::transaction(function () use ($request, $user, $code, $expired_at) {
            UserVerificationCode::where('user_id', $user->id)->delete();
            $verification_code_type = VerificationCodeType::whereName('login')->firstOrFail();
            $request->merge([
                'user_id' => $user->id,
                'token_code' => $code,
                'expired_at' => $expired_at,
                'verification_code_type_id' => $verification_code_type->id,
            ]);
            UserVerificationCode::create($request->all());
        });

        if ($request->has('method')) {
            if ($request->method === 'whatsapp' && $user->phone != null) {
                return $this->pushWhatsappLoginNotification($user, $code, $expired_at);
            }
            if ($request->method === 'email') {
                return $this->pushEmailLoginNotification($user, $code);
            }
            if ($request->method === 'device') {
                return $this->pushDeviceLoginNotification($user, $code);
            }
        }
    }

    public function pushDeviceLoginNotification($user, $code)
    {
        // send FCM Alert
        AlertLoginNotificationjob::dispatch($user->id, request()->userAgent(), $code);
        // response
        $device = Browser::parse($user->firebaseToken->user_agent);
        return $this->respondWithSuccess([
            'status' => trans('alert.success'),
            'message' => trans('alert.success-send-otp-device'),
            'device' => [
                'deviceFamily' => $device->deviceFamily(),
                'deviceModel' => $device->deviceModel(),
                'platformName' => $device->platformName(),
                'platformFamily' => $device->platformFamily(),
            ],
        ]);
    }


    public function pushEmailLoginNotification($user, $code)
    {
        try {
            $data = [
                'email' => $user->email,
                'subject' => trans('lang.login') . ' - ' . config('app.name'),
                'title' => trans('lang.login'),
                'code' => $code,
                'user' => $user,
                'message' => trans('lang.login-message'),
                'note' => trans('lang.login-note'),
            ];
            dispatch(new SendEmailLoginNotificationJob($data));
            return $this->respondWithSuccess([
                'message' => trans('alert.success-send-otp-email')
            ]);
        } catch (Exception $e) {
            info("Error: " . $e->getMessage());
        }
    }

    public function pushWhatsappLoginNotification($user, $code, $expired_at)
    {
        $dataWhatsapp = [
            'phone' =>  $user->phone,
            'msg' => $user->greeting . ' *' . $user->name . '*.

' . trans('client.verification_code') . ' : *' . $code . '*.
' . trans('client.verification_expired') . ' : ' . $expired_at->isoFormat('LLLL') . '

' . trans('client.verification_not_share') . '


*' . config('app.name') . '*',
        ];

        SendWhatsappLoginNotificationJob::dispatch(($dataWhatsapp))->delay(now()->addMinute());

        return $this->respondWithSuccess([
            'message' => trans('alert.success-send-otp-whatsapp')
        ]);
    }
}
