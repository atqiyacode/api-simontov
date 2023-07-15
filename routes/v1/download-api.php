<?php

use App\Http\Controllers\Api\v1\Download\DownloadController;
use Illuminate\Support\Facades\Route;

Route::middleware(['multilang', 'force.json', 'auth:api'])->prefix('download')->group(function () {

    //
});
