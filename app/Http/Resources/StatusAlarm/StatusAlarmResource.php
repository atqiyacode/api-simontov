<?php

namespace App\Http\Resources\StatusAlarm;

use Illuminate\Http\Resources\Json\JsonResource;

class StatusAlarmResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,

            'trashed' => $this->when(auth()->user()->hasAnyRole(['superman']), function () {
                return (bool) $this->deleted_at;
            }),
        ];
    }
}
