<?php


use App\Http\Controllers\Api\v1\Master\PermissionController;
use App\Http\Controllers\Api\v1\Master\RoleController;
use App\Http\Controllers\Api\v1\Master\UserController;

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'role:superadmin'])->prefix('master')->group(function () {
    Route::apiResource('role', RoleController::class);
    Route::apiResource('permission', PermissionController::class);
    // master data
    Route::apiResource('user', UserController::class);
    Route::put('user/clearPendingEmail/{id}', [UserController::class, 'clearPendingEmail']);
    Route::post('user/resendPendingEmailVerificationMail/{id}', [UserController::class, 'resendPendingEmailVerificationMail']);
    Route::post('user/restore/{id}', [UserController::class, 'restore']);
    Route::delete('user/delete/{id}', [UserController::class, 'delete']);
});
