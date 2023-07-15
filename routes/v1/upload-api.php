<?php

use App\Http\Controllers\Api\v1\Upload\UploadController;
use Illuminate\Support\Facades\Route;

Route::middleware(['multilang', 'force.json', 'auth:api'])->prefix('upload')->group(function () {
    Route::post('homeSlider', [UploadController::class, 'homeSlider']);
    Route::delete('homeSlider/delete/{id}', [UploadController::class, 'deleteHomeSlider']);
});
