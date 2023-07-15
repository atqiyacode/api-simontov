<?php

use App\Http\Controllers\Api\v1\Master\AuthVerificationMethodController;
use App\Http\Controllers\Api\v1\Master\MobileAppServerStatusController;
use App\Http\Controllers\Api\v1\Master\PermissionController;
use App\Http\Controllers\Api\v1\Master\RoleController;
use App\Http\Controllers\Api\v1\Master\UserController;
use App\Http\Controllers\Api\v1\Master\VerificationCodeTypeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['multilang', 'force.json', 'auth:api'])->prefix('master')->group(function () {

    // role - permission - user
    Route::apiResource('role', RoleController::class);
    Route::apiResource('permission', PermissionController::class);
    Route::apiResource('user', UserController::class);
    Route::post('user-restore/{id}', [UserController::class, 'restore']);
    Route::delete('user-delete/{id}', [UserController::class, 'delete']);

    // user
    Route::get('simple-users', [UserController::class, 'simple']);

    // verification code type
    Route::apiResource('verificationCodeType', VerificationCodeTypeController::class);

    Route::apiResource('authVerificationMethod', AuthVerificationMethodController::class);

    Route::apiResource('mobileAppServerStatus', MobileAppServerStatusController::class)->only(['index', 'show', 'update']);
});
