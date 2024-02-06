<?php

namespace App\Http\Resources\LocationNotification;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationNotificationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'location_id' => $this->location_id,
            'message' => $this->message,
            'alert_notification_type_id' => $this->alert_notification_type_id,
            'location' => $this->location,
            'alertNotificationType' => $this->alertNotificationType,
            'created_at' => $this->created_at->isoFormat('LLLL'),
            'updated_at' => $this->updated_at->isoFormat('LLLL'),
        ];
    }
}
