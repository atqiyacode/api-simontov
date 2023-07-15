<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaintenanceMobileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'enable' => $this->status->name === 'active' ? true : false,
            'is_maintenance' => true,
            'msg' => [
                'title' => trans('alert.app_maintenance'),
                'message' => trans('alert.app_maintenance_message'),
            ],
        ];
    }
}
