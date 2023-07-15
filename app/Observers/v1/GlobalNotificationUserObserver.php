<?php

namespace App\Observers\v1;

use App\Events\v1\GlobalNotificationUserEvent;
use App\Events\v1\GlobalNotificationUserUpdateEvent;
use App\Http\Resources\v1\GlobalNotificationResource;
use App\Http\Resources\v1\GlobalNotificationUserResource;
use App\Jobs\v1\SendEmailGlobalNotificationJob;
use App\Jobs\v1\SendWhatsappGlobalNotificationJob;
use App\Models\v1\GlobalNotificationUser;

class GlobalNotificationUserObserver
{
    /**
     * Handle the GlobalNotificationUser "created" event.
     */
    public function created(GlobalNotificationUser $globalNotificationUser): void
    {
        $data = new GlobalNotificationUserResource($globalNotificationUser);
        $type = $data->notification->type->slug;
        if ($type === 'whatsapp-notification') {
            // send whatsapp message
            dispatch(new SendWhatsappGlobalNotificationJob($data));
        }
        if ($type === 'email-notification') {
            // send to user email
            dispatch(new SendEmailGlobalNotificationJob($data));
        }
        if ($type === 'global-notification') {
            // send to user general notification
            GlobalNotificationUserEvent::dispatch(new GlobalNotificationUserResource($globalNotificationUser));
        }
    }

    /**
     * Handle the GlobalNotificationUser "updated" event.
     */
    public function updated(GlobalNotificationUser $globalNotificationUser): void
    {
        GlobalNotificationUserUpdateEvent::dispatch(new GlobalNotificationUserResource($globalNotificationUser));
    }

    /**
     * Handle the GlobalNotificationUser "deleted" event.
     */
    public function deleted(GlobalNotificationUser $globalNotificationUser): void
    {
        GlobalNotificationUserUpdateEvent::dispatch(new GlobalNotificationUserResource($globalNotificationUser));
    }

    /**
     * Handle the GlobalNotificationUser "restored" event.
     */
    public function restored(GlobalNotificationUser $globalNotificationUser): void
    {
        //
    }

    /**
     * Handle the GlobalNotificationUser "force deleted" event.
     */
    public function forceDeleted(GlobalNotificationUser $globalNotificationUser): void
    {
        //
    }
}
