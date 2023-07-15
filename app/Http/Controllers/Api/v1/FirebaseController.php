<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Firebase\FirebaseMessageRequest;
use App\Http\Requests\v1\Firebase\FirebaseNotificationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Kutia\Larafirebase\Facades\Larafirebase;

class FirebaseController extends Controller
{
    public function sendNotification(FirebaseNotificationRequest $request)
    {
        try {
            $userDeviceTokens = User::whereNotNull('device_token')->notCurrent()->pluck('device_token')->toArray();
            return Larafirebase::withTitle($request->title)
                ->withBody($request->body)
                ->withImage('https://ibr.tricitta.co.id/layout/images/logo-ibr.png')
                // ->withIcon('https://ibr.tricitta.co.id/layout/images/logo-ibr.png')
                ->withSound('defaultnotification.wav')
                ->withPriority('high')
                ->withAdditionalData([
                    'color' => '#rrggbb',
                    'badge' => 1000,
                    'id' => 2,
                    'data' => $request->body
                ])
                ->sendNotification($userDeviceTokens);
        } catch (\Exception $e) {
            report($e);
            return response()->json(trans('alert.failed'), 400);
        }
    }

    public function sendMessage(FirebaseMessageRequest $request)
    {
        try {
            $userDeviceTokens = User::whereNotNull('device_token')->notCurrent()->pluck('device_token')->toArray();
            return Larafirebase::withTitle($request->title)
                ->withBody($request->body)
                ->sendMessage($userDeviceTokens);
        } catch (\Throwable $e) {
            report($e);
            return response()->json(trans('alert.failed'), 400);
        }
    }
}
