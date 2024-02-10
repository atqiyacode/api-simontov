<?php

namespace App\Http\Resources\Location;

use App\Http\Resources\LocationNotification\LocationNotificationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationUserResource extends JsonResource
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
            'code' => $this->code,
            'company_name' => $this->company_name,
            'name' => $this->name,
            'longitude' => floatval($this->longitude),
            'lattitude' => floatval($this->lattitude),
            'description' => $this->description,
            'flowrates' => new LocationFlowrateResource($this->flowrates),
            'notifications' => $this->notifications,

            'charts' => $this->charts->pluck('code'),
        ];
    }
}
