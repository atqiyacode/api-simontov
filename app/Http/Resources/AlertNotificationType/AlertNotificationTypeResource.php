<?php

namespace App\Http\Resources\AlertNotificationType;

use Illuminate\Http\Resources\Json\JsonResource;

class AlertNotificationTypeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'job_event' => $this->job_event,
            'description' => $this->description,
            'created_at' => dateTimeFormat($this->created_at),
            'updated_at' => dateTimeFormat($this->updated_at),
        ];
    }
}
