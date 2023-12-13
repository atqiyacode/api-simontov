<?php

namespace App\Http\Resources\RangeCost;

use App\Http\Resources\RangeType\RangeTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RangeCostResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'range_type_id' => $this->range_type_id,
            'value' => $this->value,
            'range_type' => new RangeTypeResource($this->rangeType),
            'trashed' => $this->when(auth()->user()->hasAnyRole(['superman']), function () {
                return (bool) $this->deleted_at;
            }),
        ];
    }
}
