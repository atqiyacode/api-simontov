<?php

use App\Http\Controllers\Api\v1\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\v1\Auth\GenerateTokenCodeController;
use App\Http\Controllers\Api\v1\Auth\LoginController;
use App\Http\Controllers\Api\v1\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['multilang', 'force.json'])->prefix('auth')->group(function () {
    Route::middleware(['guest'])->group(function () {
        // login
        Route::post('/login', [LoginController::class, 'store'])
            ->middleware(['throttle:6,1']);

        Route::post('/login/verify', [LoginController::class, 'verify'])
            ->middleware(['throttle:6,1']);

        Route::post('/login/pin-verify', [LoginController::class, 'pinVerify'])
            ->middleware(['throttle:6,1']);

        Route::post('/generateTokenCode', [GenerateTokenCodeController::class, 'index'])
            ->middleware(['throttle:6,1']);
        // end login

        // register
        Route::post('/register', [RegisterController::class, 'index'])
            ->middleware(['throttle:6,1']);
        Route::post('/register/check', [RegisterController::class, 'check'])
            ->middleware(['throttle:6,1']);
        Route::post('/register/verify', [RegisterController::class, 'verify'])
            ->middleware(['throttle:6,1']);
        Route::post('/register/resend', [RegisterController::class, 'resend'])
            ->middleware(['throttle:6,1']);
        // end register

        // forgot password
        Route::post('/forgotPassword/check', [ForgotPasswordController::class, 'check'])
            ->middleware(['throttle:6,1']);
        Route::post('/resetPassword', [ForgotPasswordController::class, 'resetPassword'])
            ->middleware(['throttle:6,1']);
        Route::post('/resetPassword/token', [ForgotPasswordController::class, 'getTokenResetPassword'])
            ->middleware(['throttle:6,1']);
        // end forgot password
    });

    Route::middleware(['auth:api'])->group(function () {
        Route::post('/firebaseToken', [LoginController::class, 'firebaseToken']);
        Route::post('/logout', [LoginController::class, 'destroy']);
        Route::post('/logout-all', [LoginController::class, 'removeTokens']);
    });
});
