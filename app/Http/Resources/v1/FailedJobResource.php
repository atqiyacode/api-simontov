<?php

namespace App\Http\Resources\v1;

use App\Http\Resources\DateFormatResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FailedJobResource extends JsonResource
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
            'uuid' => (string) $this->uuid,
            'connection' => (string) $this->connection,
            'exception' => (string) $this->exception,
            'payload' => json_decode($this->payload, true),
            'date' => new DateFormatResource($this->failed_at),
        ];
    }
}
