<?php

use App\Http\Controllers\Api\v1\Auth\LoginController;
use App\Http\Controllers\Api\v1\Client\ClientAuthVerificationMethodController;
use App\Http\Controllers\Api\v1\Client\ClientMobileAddressController;
use App\Http\Controllers\Api\v1\Client\ClientMobileAnnualTaxController;
use App\Http\Controllers\Api\v1\Client\ClientMobileContactController;
use App\Http\Controllers\Api\v1\Client\ClientMobileController;
use App\Http\Controllers\Api\v1\Client\ClientMobileDeveloperNoteController;
use App\Http\Controllers\Api\v1\Client\ClientMobileNotificationController;
use App\Http\Controllers\Api\v1\Client\ClientMobilePayslipController;
use App\Http\Controllers\Api\v1\Client\ClientMobilePersonalNotificationController;
use App\Http\Controllers\Api\v1\Client\ClientMobileThrController;
use App\Http\Controllers\Api\v1\Client\ClientMobileUserController;
use App\Http\Controllers\Api\v1\Client\ClientPinController;
use App\Http\Controllers\Api\v1\Mobile\CheckUpdateController;
use App\Http\Resources\v1\Client\ClientCurrentResource;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

Route::middleware(['multilang', 'force.json', 'auth:api', 'role:employee|privateAccess|superadmin|admin'])->group(function () {

    Broadcast::routes();

    Route::get('/session', function () {
        return new ClientCurrentResource(request()->user());
    });

    Route::post('/check-pin', [ClientPinController::class, 'index'])
        ->middleware(['throttle:6,1']);
    Route::post('/new-pin', [ClientPinController::class, 'store']);
    Route::put('/update-pin', [ClientPinController::class, 'update']);
    Route::post('/delete-pin', [ClientPinController::class, 'delete']);


    Route::post('/firebaseToken', [LoginController::class, 'firebaseToken']);

    Route::get('mobileAppMenu', [ClientMobileController::class, 'mobileAppMenu']);
    Route::get('mobileStatus', [ClientMobileController::class, 'mobileStatus']);
    Route::get('homeSlider', [ClientMobileController::class, 'homeSlider']);
    Route::get('companyInformation', [ClientMobileController::class, 'companyInformation']);
    Route::get('loginHistory', [ClientMobileController::class, 'loginHistory']);

    Route::get('user/tokens', [ClientMobileUserController::class, 'tokens']);

    Route::put('user/email', [ClientMobileUserController::class, 'email']);
    Route::post('user/email/resend', [ClientMobileUserController::class, 'resendEmail'])->middleware(['throttle:1,5']);
    Route::post('user/email/cancel', [ClientMobileUserController::class, 'cancelEmail']);
    Route::put('user/phone', [ClientMobileUserController::class, 'phone']);
    Route::put('user/password', [ClientMobileUserController::class, 'password']);
    Route::post('user/avatar', [ClientMobileUserController::class, 'avatar']);

    Route::get('notification/count', [ClientMobileNotificationController::class, 'countNotification']);
    Route::apiResource('notification', ClientMobileNotificationController::class);
    Route::delete('delete-notification', [ClientMobileNotificationController::class, 'destroyAll']);

    Route::get('personalNotificationUser/count', [ClientMobilePersonalNotificationController::class, 'countNotification']);
    Route::apiResource('personalNotificationUser', ClientMobilePersonalNotificationController::class);
    Route::delete('delete-personalNotificationUser', [ClientMobilePersonalNotificationController::class, 'destroyAll']);

    Route::apiResource('contact', ClientMobileContactController::class)->only(['index']);

    Route::get('developer/note/{id}', [ClientMobileDeveloperNoteController::class, 'index']);
    Route::get('developer/faq', [ClientMobileDeveloperNoteController::class, 'faq']);


    require __DIR__ . '/v1/indonesia-api.php';
});

Route::middleware(['multilang', 'force.json'])->group(function () {
    Route::get('developer/note/{id}', [ClientMobileDeveloperNoteController::class, 'index']);
    Route::get('developer/faq', [ClientMobileDeveloperNoteController::class, 'faq']);
    Route::get('authVerificationMethod', [ClientAuthVerificationMethodController::class, 'index']);

    Route::get('checkUpdateMobile', [CheckUpdateController::class, 'mobile']);
    Route::get('checkUpdateWebsite', [CheckUpdateController::class, 'website']);
    Route::get('mobileAppFile/download', [CheckUpdateController::class, 'download']);

    Route::get('mobileAppServerStatus', [CheckUpdateController::class, 'mobileAppServerStatus']);

    require __DIR__ . '/v1/auth-api.php';
});
