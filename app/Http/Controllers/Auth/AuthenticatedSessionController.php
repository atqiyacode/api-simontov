<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Location\LocationUserResource;
use App\Http\Resources\User\CurrentUserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $user = auth()->user();

        $tokenData = $user->createToken($user->email);

        if (!$user->email_verified_at) {
            $user->email_verified_at = now();
            $user->update();
        }
        // $token = $tokenData->accessToken;
        $token = $tokenData->plainTextToken;
        $cookie = $this->getCookieDetails($token);
        return response()
            ->json([
                'user' => new CurrentUserResource($user),
                'token' => $token,
            ], 200)
            ->cookie($cookie['name'], $cookie['value'], $cookie['minutes'], $cookie['path'], $cookie['domain'], $cookie['secure'], $cookie['httponly'], $cookie['samesite']);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        $cookie = Cookie::forget(config('app.token_cookie'));
        return response()->json([
            'message' => trans('alert.success-logout')
        ])->withCookie($cookie);
    }

    private function getCookieDetails($token)
    {
        return [
            'name' => config('app.token_cookie'),
            'value' => $token,
            'minutes' => now()->diffInMinutes(now()->addMonth()),
            'path' => null,
            'domain' => null,
            'secure' => app()->isProduction() ? true : null,
            'httponly' => true,
            'samesite' => true,
        ];
    }

    public function sessionLocation(): JsonResponse
    {
        // $user = User::with('locations')->whereId(auth()->user()->id)->firstOrFail();
        $data = LocationUserResource::collection(auth()->user()->locations);
        return response()->json($data, 200);
    }
}
