<?php

namespace App\Http\Resources\RangeType;

use Illuminate\Http\Resources\Json\JsonResource;

class RangeTypeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'label' => $this->label,
            'lower_limit' => $this->lower_limit,
            'upper_limit' => $this->upper_limit,
            'description' => $this->description,

            'trashed' => $this->when(auth()->user()->hasAnyRole(['superman']), function () {
                return (bool) $this->deleted_at;
            }),
        ];
    }
}
