<?php

namespace App\Http\Resources\RangeCost;

use Illuminate\Http\Resources\Json\JsonResource;

class RangeCostResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'range_type_id' => $this->range_type_id,
            'value' => $this->value,
            'range_type' => $this->rangeType,
            'created_at' => dateTimeFormat($this->created_at),
            'updated_at' => dateTimeFormat($this->updated_at),
            'trashed' => $this->when(auth()->user()->hasAnyRole(['superman']), function () {
                return (bool) $this->deleted_at;
            }),
        ];
    }
}
