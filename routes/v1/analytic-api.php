<?php

use App\Http\Controllers\Api\v1\Analytic\DataAnalyticController;
use App\Http\Controllers\Api\v1\Analytic\LogUserActivityController;
use Illuminate\Support\Facades\Route;

Route::middleware(['multilang', 'force.json', 'auth:api'])->prefix('analytic')->group(function () {
    // analytic
    Route::get('main', [DataAnalyticController::class, 'index']);

    // user
    Route::apiResource('/logUserActivity', LogUserActivityController::class)->only(['index', 'show', 'destroy']);
});
