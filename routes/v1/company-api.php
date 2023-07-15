<?php

use App\Http\Controllers\Api\v1\Company\CompanyInformationController;
use App\Http\Controllers\Api\v1\Company\HomeSliderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['multilang', 'force.json', 'auth:api'])->prefix('company')->group(function () {

    // homeSlider
    Route::apiResource('homeSlider', HomeSliderController::class);
    // Route::post('homeSlider/{homeSlider}/update', [HomeSliderController::class, 'update']);
    Route::post('homeSlider-restore/{id}', [HomeSliderController::class, 'restore']);
    Route::delete('homeSlider-delete/{id}', [HomeSliderController::class, 'delete']);
    // end homeSlider

    // companyInformation
    Route::apiResource('companyInformation', CompanyInformationController::class);
    Route::post('companyInformation-restore/{id}', [CompanyInformationController::class, 'restore']);
    Route::delete('companyInformation-delete/{id}', [CompanyInformationController::class, 'delete']);
    // end companyInformation
});
