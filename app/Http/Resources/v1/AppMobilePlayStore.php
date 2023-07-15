<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppMobilePlayStore extends JsonResource
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
                'title' => $this->build->name === 'release' ? trans('alert.app_apk_release') : trans('alert.app_apk'),
                'message' => $this->build->name === 'release' ? trans('alert.app_apk_message_release') : trans('alert.app_apk_message'),
                'btn' => $this->build->name === 'release' ? trans('alert.app_apk_open_playstore') : trans('alert.app_apk_btn')
            ],
        ];
    }
}
