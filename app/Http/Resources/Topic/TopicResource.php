<?php

namespace App\Http\Resources\Topic;

use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
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
