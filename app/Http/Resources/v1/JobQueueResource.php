<?php

namespace App\Http\Resources\v1;

use App\Http\Resources\DateFormatResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobQueueResource extends JsonResource
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
            'queue' => $this->queue,
            'attempts' => (string) $this->attempts,
            'reserved_at' => $this->reserved_at,
            'available_at' => Carbon::parse($this->available_at)->isoFormat('LLLL'),
            'payload' => json_decode($this->payload, true),
            'date' => new DateFormatResource($this->created_at),
        ];
    }
}
