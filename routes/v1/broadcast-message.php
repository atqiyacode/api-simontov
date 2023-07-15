<?php

use App\Events\v1\MobileVersionEvent;
use App\Events\v1\GlobalMessage;
use App\Events\v1\MobileAppMenuEvent;
use App\Events\v1\PrivateMessage;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware(['multilang'])->group(function () {
    // broadcast test
    Route::prefix('socket')->group(function () {

        Route::get('/global-test', function () {
            GlobalMessage::dispatch([
                'data' => [
                    'title' => 'Private Message',
                    'message' => 'Welcome to Our App',
                ]
            ]);
        });

        Route::get('/app-version-test', function () {
            MobileVersionEvent::dispatch('App Version');
        });

        Route::get('/mobile-app-menu-test', function () {
            MobileAppMenuEvent::dispatch('Mobile App Menu');
        });

        Route::get('/private-test', function () {
            $user = User::role(['privateAccess'])->notCurrent()->pluck('id')->toArray();
            foreach ($user as $key => $value) {
                PrivateMessage::dispatch([
                    'id' => $value,
                    'data' => 'Private Message'
                ]);
            }
            // PrivateMessage::dispatch([
            //     'id' => 664,
            //     'data' => [
            //         'title' => 'Private Message',
            //         'message' => 'Welcome to Our App',
            //     ]
            // ]);
        })->middleware(['auth:api']);
    });
});
