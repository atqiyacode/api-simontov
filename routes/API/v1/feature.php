<?php

use App\Http\Controllers\Api\v1\Features\FlowrateController;
use App\Http\Controllers\Api\v1\Features\RangeCostController;
use App\Http\Controllers\Api\v1\Features\RangeTypeController;
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

    // rangeType
    Route::apiResource('rangeType', RangeTypeController::class);
    Route::post('rangeType/restore/{id}', [RangeTypeController::class, 'restore']);
    Route::delete('rangeType/delete/{id}', [RangeTypeController::class, 'delete']);

    // rangeCost
    Route::apiResource('rangeCost', RangeCostController::class);
    Route::post('rangeCost/restore/{id}', [RangeCostController::class, 'restore']);
    Route::delete('rangeCost/delete/{id}', [RangeCostController::class, 'delete']);
});
