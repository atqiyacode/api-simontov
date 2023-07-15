<?php

namespace App\Http\Resources\v1;

use App\Http\Resources\DateFormatResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonalNotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_get_notify' => (int) $this->user->count(),
            'label' => $this->label,
            'message' => $this->message,
            'short_message' => $this->short_message,
            'sender' => new UserShortResource($this->sender),
            'created' => new DateFormatResource($this->created_at),
            'trashed' => (bool) $this->deleted_at,
        ];
    }
}
