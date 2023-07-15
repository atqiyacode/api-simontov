<?php

use App\Http\Controllers\Api\v1\Config\JobQueueController;
use Illuminate\Support\Facades\Route;

Route::middleware(['multilang', 'force.json', 'auth:api'])->prefix('job')->group(function () {
  // queue job
  Route::apiResource('/queue', JobQueueController::class)->only(['index', 'destroy']);
  Route::post('/killJob', [JobQueueController::class, 'killJob']);
  // failed job
  Route::get('/failed', [JobQueueController::class, 'failedJob']);
  Route::post('/flushJob', [JobQueueController::class, 'flushJob']);
  Route::delete('/failed/{id}', [JobQueueController::class, 'deleteFailedJob']);
  Route::post('/retryJob', [JobQueueController::class, 'retryJob']);
});
