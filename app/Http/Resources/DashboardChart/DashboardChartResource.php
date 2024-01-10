<?php

namespace App\Http\Resources\DashboardChart;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardChartResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'status' => (bool) $this->status,

            'trashed' => $this->when(auth()->check() && auth()->user()->hasAnyRole(['superman']), function () {
                return (bool) $this->deleted_at;
            }),
        ];
    }
}
