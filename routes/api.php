<?php

use App\Http\Resources\v1\CurrentUserResource;
use Illuminate\Support\Facades\Route;

Route::middleware(['multilang', 'force.json'])->group(function () {

    Route::middleware(['auth:api'])->get('/session', function () {
        return new CurrentUserResource(request()->user());
    });
});
