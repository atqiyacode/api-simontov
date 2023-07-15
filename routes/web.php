<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $online = [
        'App name' => config('app.name'),
        'Version' => '2.1.5',
        'Year' => (int) now()->format('Y'),
        'Author' => 'PT. TRICITA SYNERGY',
        'Developer' => 'atqiyacode',
    ];
    $debug = [
        'Debug' => config('app.debug'),
        'Framework Version' => app()->version(),
        'Year' => now()->format('Y'),
        'Mail' => config('mail'),
        'Environment' => config('app'),
    ];
    return config('app.debug') ? $debug : $online;
});
