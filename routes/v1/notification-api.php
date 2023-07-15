<?php

use App\Http\Controllers\Api\v1\FirebaseController;
use App\Http\Controllers\Api\v1\Notification\GlobalNotificationController;
use App\Http\Controllers\Api\v1\Notification\GlobalNotificationUserController;
use App\Http\Controllers\Api\v1\Notification\NotificationTypeController;
use App\Http\Controllers\Api\v1\Notification\PersonalNotificationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['multilang', 'force.json', 'auth:api'])->prefix('notification')->group(function () {
    // notificationType
    Route::apiResource('notificationType', NotificationTypeController::class);
    Route::post('notificationType-restore/{id}', [NotificationTypeController::class, 'restore']);
    Route::delete('notificationType-delete/{id}', [NotificationTypeController::class, 'delete']);

    // globalNotification
    Route::apiResource('globalNotification', GlobalNotificationController::class);
    Route::post('globalNotification-restore/{id}', [GlobalNotificationController::class, 'restore']);
    Route::delete('globalNotification-delete/{id}', [GlobalNotificationController::class, 'delete']);

    // personalNotification
    Route::apiResource('personalNotification', PersonalNotificationController::class);
    Route::post('personalNotification-restore/{id}', [PersonalNotificationController::class, 'restore']);
    Route::delete('personalNotification-delete/{id}', [PersonalNotificationController::class, 'delete']);

    // globalNotificationUser
    Route::apiResource('globalNotificationUser', GlobalNotificationUserController::class);

    Route::middleware(['role:privateAccess|superadmin'])->prefix('firebase')->group(function () {
        Route::post('notification', [FirebaseController::class, 'sendNotification']);
        Route::post('message', [FirebaseController::class, 'sendMessage']);
    });
});
