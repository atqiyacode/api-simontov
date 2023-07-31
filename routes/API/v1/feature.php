<?php

use App\Http\Controllers\Api\v1\Features\FlowrateController;
use App\Http\Controllers\Api\v1\Features\StatusAlarmController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'role:superadmin'])->prefix('feature')->group(function () {
    // flowrates
    Route::apiResource('flowrate', FlowrateController::class);
    Route::post('flowrate/restore/{id}', [FlowrateController::class, 'restore']);
    Route::delete('flowrate/delete/{id}', [FlowrateController::class, 'delete']);

    // status alarm
    Route::apiResource('statusAlarm', StatusAlarmController::class);
    Route::post('statusAlarm/restore/{id}', [StatusAlarmController::class, 'restore']);
    Route::delete('statusAlarm/delete/{id}', [StatusAlarmController::class, 'delete']);
});
