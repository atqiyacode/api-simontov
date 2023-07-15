<?php

namespace App\Http\Resources\v1\Client;

use App\Http\Resources\DateFormatResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientNotificationResource extends JsonResource
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
            'status' => $this->status,
            'created' => new DateFormatResource($this->created_at),
            'label' => $this->message->label,
            'message' => $this->message->message,
        ];
    }
}
