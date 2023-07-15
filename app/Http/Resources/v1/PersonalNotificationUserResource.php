<?php

namespace App\Http\Resources\v1;

use App\Http\Resources\DateFormatResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonalNotificationUserResource extends JsonResource
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
            'status' => (bool) $this->status,
            'user_id' => $this->user->user_id,
            'email' => $this->user->email,
            'phone' => $this->user->phone,
            'notification' => new PersonalNotificationResource($this->notification),
            'created' => new DateFormatResource($this->created_at),
            'trashed' => (bool) $this->deleted_at,
        ];
    }
}
