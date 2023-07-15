<?php

namespace App\Observers\v1;

use App\Models\v1\PersonalNotification;
use App\Models\v1\PersonalNotificationUser;
use App\Models\v1\UserFirebaseToken;
use Kutia\Larafirebase\Facades\Larafirebase;

class PersonalNotificationObserver
{
    /**
     * Handle the PersonalNotification "created" event.
     */
    public function created(PersonalNotification $personalNotification): void
    {
        DB::transaction(function () use ($personalNotification) {
            $collectUsers = User::when($personalNotification->type->slug === 'whatsapp-notification', function ($query) {
                return $query->hasPhone();
            })
                ->when($personalNotification->type->slug === 'email-notification', function ($query) {
                    return $query->hasEmail();
                })
                ->when($personalNotification->type->slug === 'global-notification', function ($query) {
                    // return app()->isProduction() ? $query->active() : $query->where('username', '10000');
                    return $query->active();
                })
                ->get();
            foreach ($collectUsers as $key) {
                PersonalNotificationUser::create([
                    'user_id' => $key->id,
                    'global_notification_id' => $personalNotification->id,
                ]);
            }
            $userFirebaseToken = UserFirebaseToken::get()->pluck('device_token');
            foreach ($userFirebaseToken as $key => $device_token) {
                if ($device_token) {
                    try {
                        return Larafirebase::withTitle($personalNotification->label)
                            ->withBody($personalNotification->message)
                            ->withImage('https://ibr.tricitta.co.id/layout/images/logo-ibr.png')
                            ->withIcon('https://ibr.tricitta.co.id/layout/images/logo-ibr.png')
                            ->withPriority('normal')
                            ->withAdditionalData([
                                'data' => $personalNotification->message
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
     * Handle the PersonalNotification "updated" event.
     */
    public function updated(PersonalNotification $personalNotification): void
    {
        //
    }

    /**
     * Handle the PersonalNotification "deleted" event.
     */
    public function deleted(PersonalNotification $personalNotification): void
    {
        //
    }

    /**
     * Handle the PersonalNotification "restored" event.
     */
    public function restored(PersonalNotification $personalNotification): void
    {
        //
    }

    /**
     * Handle the PersonalNotification "force deleted" event.
     */
    public function forceDeleted(PersonalNotification $personalNotification): void
    {
        //
    }
}
