<?php

use App\Http\Resources\v1\CurrentUserResource;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;


Route::middleware(['multilang', 'force.json'])->group(function () {

    Broadcast::routes([
        'middleware' => ['auth:api']
    ]);

    Route::middleware(['auth:api'])->get('/session', function () {
        return new CurrentUserResource(request()->user());
    });
});


require __DIR__ . '/v1/indonesia-api.php';
require __DIR__ . '/v1/auth-api.php';
require __DIR__ . '/v1/master-api.php';
require __DIR__ . '/v1/company-api.php';
require __DIR__ . '/v1/others-api.php';
require __DIR__ . '/v1/notification-api.php';
require __DIR__ . '/v1/mobile-api.php';
require __DIR__ . '/v1/info-api.php';
require __DIR__ . '/v1/config-api.php';
require __DIR__ . '/v1/analytic-api.php';
require __DIR__ . '/v1/job-api.php';
require __DIR__ . '/v1/download-api.php';
require __DIR__ . '/v1/upload-api.php';

require __DIR__ . '/v1/broadcast-message.php';
