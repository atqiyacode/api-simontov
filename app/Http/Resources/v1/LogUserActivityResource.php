<?php

namespace App\Http\Resources\v1;

use App\Http\Resources\DateFormatResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LogUserActivityResource extends JsonResource
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
            'user_id' => $this->user_id,
            'log_date' => new DateFormatResource($this->log_date),
            'table_name' => $this->table_name,
            'log_type' => $this->log_type,
            'data' => $this->getJsonDataAttribute(),
            'user' => $this->user,
        ];
    }
}
