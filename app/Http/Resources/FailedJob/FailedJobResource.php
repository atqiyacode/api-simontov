<?php

namespace App\Http\Resources\FailedJob;

use Illuminate\Http\Resources\Json\JsonResource;

class FailedJobResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,

            'created_at' => dateTimeFormat($this->created_at),
            'updated_at' => dateTimeFormat($this->updated_at),
            'trashed' => $this->when(auth()->user()->hasAnyRole(['superman']), function () {
                return (bool) $this->deleted_at;
            }),
        ];
    }
}
