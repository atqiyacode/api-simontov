<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,

            'roles' => $this->roles->pluck('id'),
            'permissions' => $this->permissions->pluck('id'),
            'locations' => $this->locations->pluck('id'),
            'dashboardCharts' => $this->dashboardCharts->pluck('id'),

            'roles_name' => $this->roles->pluck('name'),
            'permissions_name' => $this->permissions->pluck('name'),
            'locations_name' => $this->locations->pluck('name'),

            // 'dashboardCharts_name' => $this->dashboardCharts->pluck('name'),


            'trashed' => $this->when(auth()->user(), function () {
                if (auth()->user()->hasAnyRole(['superman'])) {
                    return (bool) $this->deleted_at;
                }
            }),
        ];
    }
}
