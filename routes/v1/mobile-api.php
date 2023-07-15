<?php

use App\Http\Controllers\Api\v1\Mobile\CheckUpdateController;
use App\Http\Controllers\Api\v1\Mobile\MobileAppMenuController;
use App\Http\Controllers\Api\v1\Mobile\MobileBuildTypeController;
use App\Http\Controllers\Api\v1\Mobile\MobileDeviceTypeController;
use App\Http\Controllers\Api\v1\Mobile\MobileStatusController;
use App\Http\Controllers\Api\v1\Mobile\MobileVersionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['multilang', 'force.json'])->prefix('mobile')->group(function () {
  Route::middleware(['auth:api'])->group(function () {
    // mobileDeviceType
    Route::apiResource('mobileDeviceType', MobileDeviceTypeController::class);
    Route::post('mobileDeviceType-restore/{id}', [MobileDeviceTypeController::class, 'restore']);
    Route::delete('mobileDeviceType-delete/{id}', [MobileDeviceTypeController::class, 'delete']);
    // end mobileDeviceType

    // mobileBuildType
    Route::apiResource('mobileBuildType', MobileBuildTypeController::class);
    Route::post('mobileBuildType-restore/{id}', [MobileBuildTypeController::class, 'restore']);
    Route::delete('mobileBuildType-delete/{id}', [MobileBuildTypeController::class, 'delete']);
    // end mobileBuildType

    // mobileStatus
    Route::apiResource('mobileStatus', MobileStatusController::class);
    Route::post('mobileStatus-restore/{id}', [MobileStatusController::class, 'restore']);
    Route::delete('mobileStatus-delete/{id}', [MobileStatusController::class, 'delete']);
    // end mobileStatus

    // mobileVersion
    Route::apiResource('mobileVersion', MobileVersionController::class);
    Route::post('mobileVersion-restore/{id}', [MobileVersionController::class, 'restore']);
    Route::delete('mobileVersion-delete/{id}', [MobileVersionController::class, 'delete']);
    // end mobileVersion

    // mobileAppMenu
    Route::apiResource('mobileAppMenu', MobileAppMenuController::class);
    Route::post('mobileAppMenu-restore/{id}', [MobileAppMenuController::class, 'restore']);
    Route::delete('mobileAppMenu-delete/{id}', [MobileAppMenuController::class, 'delete']);
    // end mobileAppMenu
  });

  // no need authorization
  // checkUpdate
  Route::apiResource('checkUpdate', CheckUpdateController::class)->only(['index', 'show']);
  // end checkUpdate
});
