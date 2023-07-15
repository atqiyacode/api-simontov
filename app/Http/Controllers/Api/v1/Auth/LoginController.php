<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Events\v1\AskClientLoginEvent;
use App\Events\v1\ClientLogoutEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PinVerifyLoginRequest;
use App\Http\Requests\v1\Login\CheckUserPinRequest;
use App\Http\Requests\v1\Login\FirebaseTokenRequest;
use App\Http\Requests\v1\Login\LoginCheckRequest;
use App\Http\Requests\v1\VerifyLoginRequest;
use App\Http\Resources\v1\CurrentUserResource;
use App\Jobs\v1\AlertLoginNotificationjob;
use App\Models\User;
use App\Models\v1\LogUserActivity;
use App\Models\v1\UserFirebaseToken;
use App\Models\v1\UserVerificationCode;
use App\Models\v1\VerificationCodeType;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Browser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    use ApiResponseHelpers;

    public function store(LoginCheckRequest $request)
    {
        $user = User::withTrashed()->where('username', $request->username)
            ->firstOrFail();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'title' => trans('auth.password'),
                'message' => trans('auth.password'),
                'errors' => [
                    'password' => [trans('auth.password')]
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

        $code = config('app.random_otp') ? rand(100000, 999999) : '111111';
        $expired_at = now()->addMinutes(config('app.expired_otp'));

        if ($user->username === '10000') {
            $code = '111111';
        }

        $defaultResponse = [
            'status' => trans('alert.success'),
            'message' => trans('auth.success.2fa-text-login'),
            'username'   => $request->username,
            'password'   => $request->password,
            'hasPhone'   => (bool) $user->phone,
            'hasPin'   => (bool) $user->pin,
            'hasDevice'   => (bool) $user->firebaseToken,
            'hasEmail' => (bool) !Str::contains($user->email, ['@fakemail.com'])
        ];
        // return $this->doLogin($user, $request->password);
        return $this->respondWithSuccess($defaultResponse);
        // // device token
        // $hasDeviceToken = UserFirebaseToken::where('user_id', $user->id)->first();
        // if ($hasDeviceToken) {

        //     DB::transaction(function () use ($request, $user, $code, $expired_at) {
        //         UserVerificationCode::where('user_id', $user->id)->delete();
        //         $verification_code_type = VerificationCodeType::whereName('login')->firstOrFail();
        //         $request->merge([
        //             'user_id' => $user->id,
        //             'token_code' => $code,
        //             'expired_at' => $expired_at,
        //             'verification_code_type_id' => $verification_code_type->id,
        //         ]);
        //         UserVerificationCode::create($request->all());
        //     });
        //     // send FCM Alert
        //     AlertLoginNotificationjob::dispatch($user->id, $request->userAgent(), $code);
        //     // response
        //     $device = Browser::parse($hasDeviceToken->user_agent);
        //     return $this->respondWithSuccess([
        //         'status' => trans('alert.success'),
        //         'message' => trans('auth.success.2fa-text-login'),
        //         'device' => [
        //             'deviceFamily' => $device->deviceFamily(),
        //             'deviceModel' => $device->deviceModel(),
        //             'platformName' => $device->platformName(),
        //             'platformFamily' => $device->platformFamily(),
        //         ],
        //     ]);
        // } else {
        //     $defaultResponse = [
        //         'status' => trans('alert.success'),
        //         'message' => trans('auth.success.2fa-text-login'),
        //         'username'   => $request->username,
        //         'password'   => $request->password,
        //         'hasPhone'   => (bool) $user->phone,
        //         'hasPin'   => (bool) $user->pin,
        //         'hasDevice'   => (bool) $user->firebaseToken,
        //         'hasEmail' => (bool) !Str::contains($user->email, ['@fakemail.com'])
        //     ];
        //     // return $this->doLogin($user, $request->password);
        //     return $this->respondWithSuccess($defaultResponse);
        // }




        // $lastSession = LogUserActivity::where('user_id', $user->id)
        //     ->where('log_type', 'login')
        //     ->orderBy('id', 'DESC')
        //     ->first();

        // if (!$lastSession) {
        //     return $this->respondWithSuccess($defaultResponse);
        // } else {
        //     $lastAgent = Browser::parse(json_decode($lastSession->data)->user_agent);
        //     if ($request->userAgent() === $lastAgent->userAgent()) {
        //         return $this->doLogin($user, $request->password);
        //     } else {
        //         return $this->respondWithSuccess($defaultResponse);
        //     }
        // }
    }

    public function firebaseToken(FirebaseTokenRequest $request)
    {
        DB::transaction(function () use ($request) {
            UserFirebaseToken::create([
                'user_id' => auth()->user()->id,
                'device_token' => $request->token,
                'user_agent' => $request->userAgent()
            ]);
        });

        return $this->respondOk(trans('alert.success'));
    }




    /**
     * Store a newly created resource in storage.
     */
    public function verify(VerifyLoginRequest $request)
    {
        $user = User::where('username', $request->username)
            ->firstOrFail();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'title' => trans('auth.password'),
                'message' => trans('auth.password'),
                'errors' => [
                    'password' => [trans('auth.password')]
                ],
            ], 422);
        }

        $verification = UserVerificationCode::where('user_id', $user->id)
            ->where('token_code', $request->code)
            ->where('expired_at', '>=', now())
            ->first();

        if (!$verification) {
            return response()->json([
                'title' => trans('auth.wrong_verification_code'),
                'message' => trans('auth.wrong_verification_code'),
                'errors' => [
                    'code' => [trans('auth.wrong_verification_code')]
                ],
            ], 422);
        }

        return $this->doLogin($user, $request->password);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function pinVerify(PinVerifyLoginRequest $request)
    {
        $user = User::where('username', $request->username)
            ->firstOrFail();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'title' => trans('auth.password'),
                'message' => trans('auth.password'),
                'errors' => [
                    'password' => [trans('auth.password')]
                ],
            ], 422);
        }

        if (!Hash::check($request->pin, $user->pin)) {
            return response()->json([
                'title' => trans('auth.wrong_pin'),
                'message' => trans('auth.wrong_pin'),
                'errors' => [
                    'pin' => [trans('auth.wrong_pin')]
                ],
            ], 422);
        }

        return $this->doLogin($user, $request->password);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $device_token = UserFirebaseToken::where('user_id', $request->user()->id)->first();
        if ($device_token) {
            $device_token->delete();
        }
        $request->user()->token()->revoke();
        $request->user()->tokens()->delete();
        return response([
            'message' => trans('alert.success-logout')
        ]);
    }

    public function removeTokens(Request $request)
    {
        $request->user()->tokens()->delete();
        return response([
            'message' => trans('alert.success-logout')
        ]);
    }

    public function checkVerificationCode($userId, $code)
    {
        $verification = UserVerificationCode::where('user_id', $userId)
            ->where('token_code', $code)
            ->where('expired_at', '>=', now())
            ->first();

        if (!$verification) {
            return response()->json(trans('auth.wrong_verification_code'));
        }
    }

    public function doLogin($user, $password)
    {
        // ask active session
        // AskClientLoginEvent::dispatch($user->id);

        $credentials = [
            'email' => $user->email,
            'password' => $password,
        ];
        Auth::attempt($credentials);

        if (!$user->email_verified_at) {
            $user->email_verified_at = now();
            $user->update();
        }

        $data = [
            'user' => new CurrentUserResource(request()->user()),
            'token' => request()->user()->createToken($user->email)->accessToken,
        ];

        ClientLogoutEvent::dispatch($user->id);

        UserVerificationCode::where('user_id', $user->id)->delete();

        return $this->respondWithSuccess($data);
    }
}
