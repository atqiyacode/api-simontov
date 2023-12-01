<?php

namespace App\Http\Resources\FailedJob;

use Illuminate\Http\Resources\Json\JsonResource;

class FailedJobResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,


            'trashed' => $this->when(auth()->user()->hasAnyRole(['superman']), function () {
                return (bool) $this->deleted_at;
            }),
        ];
    }
}
