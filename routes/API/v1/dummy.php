<?php

use App\Http\Controllers\Api\v1\Features\FlowrateController;
use App\Http\Controllers\Api\v1\Master\UserController;

use Illuminate\Support\Facades\Route;

Route::get('dummy', [FlowrateController::class, 'dummy']);
Route::middleware(['auth:api', 'role:superadmin'])->prefix('dummy')->group(function () {
});
