<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/
// global
Broadcast::channel('global-channel', function () {
    return true;
});
Broadcast::channel('mobile-app-menu-channel', function () {
    return true;
});
Broadcast::channel('home-slider-channel', function () {
    return true;
});
Broadcast::channel('company-information-channel', function () {
    return true;
});
Broadcast::channel('app-version-channel', function () {
    return true;
});
Broadcast::channel('app-status-channel', function () {
    return true;
});
Broadcast::channel('auth-verification-method-channel', function () {
    return true;
});

// private
Broadcast::channel('logout-client-channel.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('ask-login-client-channel.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('lock-pin-client-channel.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('message-channel.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('personal-notification-channel.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('notification-channel.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('notification-update-channel.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('user-channel.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('user-client-channel.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
