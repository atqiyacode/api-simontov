<?php

use App\Http\Resources\CurrentUserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:api'])->get('/session', function (Request $request) {
    return new CurrentUserResource($request->user());
});

require __DIR__ . '/v1/auth.php';
require __DIR__ . '/v1/master.php';
require __DIR__ . '/v1/feature.php';
require __DIR__ . '/v1/dashboard.php';
require __DIR__ . '/v1/dummy.php';
