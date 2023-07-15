<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MajorUpdateMobileAppVersionResource extends JsonResource
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
                'title' => trans('alert.app_major'),
                'message' => trans('alert.app_major_message', ['versionName' => $this->name]),
                'btn' => trans('alert.app_apk_btn_release')
            ],
        ];
    }
}
