<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\ForgotPassword\ForgotPasswordCheckRequest;
use App\Http\Requests\v1\ForgotPassword\ResetPasswordCodeRequest;
use App\Http\Requests\v1\ForgotPassword\VerifyResetPasswordRequest;
use App\Jobs\v1\SendEmailLoginNotificationJob;
use App\Jobs\v1\SendWhatsappLoginNotificationJob;
use App\Models\User;
use App\Models\v1\Employee;
use App\Models\v1\UserVerificationCode;
use App\Models\v1\VerificationCodeType;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    use ApiResponseHelpers;

    public function check(ForgotPasswordCheckRequest $request)
    {
        $employee = Employee::where([
            'nik' => $request->nik,
            'code' => $request->code,
        ])->firstOrFail();

        $user = User::where('username', $request->code)->firstOrFail();
        $data = [
            'code' => $employee->code,
            'name' => $employee->full_name,
            'username' => $user->username,
            'email' => $user->email,
            'hasDevice' => (bool) $user->firebaseToken,
            'hasPin' => (bool) $user->pin,
            'hasPhone' => (bool) $user->phone,
            'hasEmail' => (bool) !Str::contains($user->email, ['@fakemail.com']),
        ];
        return $this->respondWithSuccess([
            'message' => trans('alert.success'),
            'data' => $data,
        ]);
    }

    public function resetPassword(VerifyResetPasswordRequest $request)
    {
        $account = User::where('username', $request->code)
            ->firstOrFail();

        $verification = UserVerificationCode::where('user_id', $account->id)
            ->where('token_code', $request->verification_code)
            ->where('expired_at', '>=', now())
            ->first();

        if (!$verification) {
            return response()->json([
                'title' => trans('auth.wrong_verification_code'),
                'message' => trans('auth.wrong_verification_code'),
                'errors' => [
                    'verification_code' => [trans('auth.wrong_verification_code')]
                ],
            ], 422);
        }

        DB::transaction(function () use ($account, $request) {
            $account->password = Hash::make($request->password);
            if (!$account->email_verified_at) {
                $account->email_verified_at = now();
            }
            $account->update();

            UserVerificationCode::where('user_id', $account->id)->delete();
        });


        return $this->respondOk(trans('alert.success-update-password'));
    }

    public function getTokenResetPassword(ResetPasswordCodeRequest $request)
    {
        $user = User::where('username', $request->code)
            ->firstOrFail();

        $code = config('app.random_otp') ? rand(100000, 999999) : '111111';
        $expired_at = now()->addMinutes(config('app.expired_otp'));

        if ($user->username === '10000') {
            $code = '111111';
        }

        DB::transaction(function () use ($request, $user, $code, $expired_at) {
            UserVerificationCode::where('user_id', $user->id)->delete();
            $verification_code_type = VerificationCodeType::whereSlug('forgot-password')->firstOrFail();
            $request->merge([
                'user_id' => $user->id,
                'token_code' => $code,
                'expired_at' => $expired_at,
                'verification_code_type_id' => $verification_code_type->id,
            ]);
            UserVerificationCode::create($request->all());
        });

        if ($request->method === 'whatsapp') {
            $this->pushWhatsappForgotPasswordNotification($user, $code, $expired_at);
            return $this->respondOk(trans('alert.success-send-reset-whatsapp'));
        }
        if ($request->method === 'email') {
            $this->pushEmailForgotPasswordNotification($user, $code);
            return $this->respondOk(trans('alert.success-send-reset-email'));
        }
    }

    // push forgot password token code
    public function pushEmailForgotPasswordNotification($user, $code)
    {
        try {
            $data = [
                'email' => $user->email,
                'subject' => trans('lang.reset-password') . ' - ' . config('app.name'),
                'title' => trans('lang.reset-password'),
                'code' => $code,
                'user' => $user,
                'message' => trans('lang.forgot-password-message'),
                'note' => trans('lang.forgot-password-note'),
            ];
            dispatch(new SendEmailLoginNotificationJob($data));
            return $this->respondWithSuccess([
                'message' => trans('alert.success-send-otp-email')
            ]);
        } catch (Exception $e) {
            info("Error: " . $e->getMessage());
        }
    }

    public function pushWhatsappForgotPasswordNotification($user, $code, $expired_at)
    {
        $dataWhatsapp = [
            'phone' =>  config('app.debug') ? config('app.whatsapp_test_number') : $user->phone,
            'msg' => $user->greeting . ' *' . $user->name . '*.

' . trans('lang.reset-password') . '.
' . trans('client.verification_code') . ' : *' . $code . '*.
' . trans('client.verification_expired') . ' : ' . $expired_at->isoFormat('LLLL') . '

' . trans('client.verification_not_share') . '


*' . config('app.name') . '*',
        ];
        dispatch(new SendWhatsappLoginNotificationJob($dataWhatsapp));

        return $this->respondWithSuccess([
            'message' => trans('alert.success-send-otp-whatsapp')
        ]);
    }
}
