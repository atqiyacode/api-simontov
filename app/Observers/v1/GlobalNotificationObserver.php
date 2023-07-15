<?php

namespace App\Observers\v1;

use App\Models\User;
use App\Models\v1\GlobalNotification;
use App\Models\v1\GlobalNotificationUser;
use App\Models\v1\UserFirebaseToken;
use Illuminate\Support\Facades\DB;
use Kutia\Larafirebase\Facades\Larafirebase;

class GlobalNotificationObserver
{
    /**
     * Handle the GlobalNotification "created" event.
     */
    public function created(GlobalNotification $globalNotification): void
    {
        DB::transaction(function () use ($globalNotification) {
            $collectUsers = User::when($globalNotification->type->slug === 'whatsapp-notification', function ($query) {
                return $query->hasPhone();
            })
                ->when($globalNotification->type->slug === 'email-notification', function ($query) {
                    return $query->hasEmail();
                })
                ->when($globalNotification->type->slug === 'global-notification', function ($query) {
                    // return app()->isProduction() ? $query->active() : $query->where('username', '10000');
                    return $query->active();
                })
                ->get();
            foreach ($collectUsers as $key) {
                GlobalNotificationUser::create([
                    'user_id' => $key->id,
                    'global_notification_id' => $globalNotification->id,
                ]);
            }
            $userFirebaseToken = UserFirebaseToken::get()->pluck('device_token');
            foreach ($userFirebaseToken as $key => $device_token) {
                if ($device_token) {
                    try {
                        return Larafirebase::withTitle($globalNotification->label)
                            ->withBody($globalNotification->message)
                            ->withImage('https://ibr.tricitta.co.id/layout/images/logo-ibr.png')
                            ->withIcon('https://ibr.tricitta.co.id/layout/images/logo-ibr.png')
                            ->withPriority('normal')
                            ->withAdditionalData([
                                'data' => $globalNotification->message
                            ])
                            ->sendNotification($device_token);
                    } catch (\Exception $e) {
                        report($e);
                        return response()->json(trans('alert.failed'), 400);
                    }
                }
            }
        });
    }

    /**
     * Handle the GlobalNotification "updated" event.
     */
    public function updated(GlobalNotification $globalNotification): void
    {
        //
    }

    /**
     * Handle the GlobalNotification "deleted" event.
     */
    public function deleted(GlobalNotification $globalNotification): void
    {
        //
    }

    /**
     * Handle the GlobalNotification "restored" event.
     */
    public function restored(GlobalNotification $globalNotification): void
    {
        //
    }

    /**
     * Handle the GlobalNotification "force deleted" event.
     */
    public function forceDeleted(GlobalNotification $globalNotification): void
    {
        //
    }
}
