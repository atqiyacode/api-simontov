<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MinorUpdateMobileAppVersionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'device' => $this->device->name,
            'code' => $this->code,
            'name' => $this->name,
            'note' => $this->note,
            'enable' => $this->status->name === 'active' ? true : false,
            'type' => $this->build->name,
            'release_url' => $this->build->name === 'release' ? $this->release_url : null,
            'msg' => [
                'title' => trans('alert.app_minor'),
                'message' => trans('alert.app_minor_message', ['versionName' => $this->name]),
                'btn_later' => trans('alert.app_minor_btn'),
                'btn' => trans('alert.app_minor_btn_confirm')
            ],
        ];
    }
}
