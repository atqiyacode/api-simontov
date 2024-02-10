<?php

namespace App\Http\Resources\Location;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;

class LocationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'company_name' => $this->company_name,
            'name' => $this->name,
            'longitude' => floatval($this->longitude),
            'lattitude' => floatval($this->lattitude),
            'description' => $this->description,

            'notifications' => $this->notifications,

            'npwp' => $this->npwp,
            'email' => $this->email,
            'pic' => $this->pic,
            'address' => $this->address,

            'charts' => (Route::is('locations.show'))
                ? $this->charts->pluck('code')
                : (Route::is('locations.index') ? $this->charts->pluck('id') : null),


            'trashed' => $this->when(auth()->check() && auth()->user()->hasAnyRole(['superman']), function () {
                return (bool) $this->deleted_at;
            }),
        ];
    }
}
