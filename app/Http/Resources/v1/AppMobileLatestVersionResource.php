<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppMobileLatestVersionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'enable' => false,
            'is_maintenance' => false,
            'msg' => [
                'title' => trans('alert.congratulation'),
                'message' => trans('alert.app-latest'),
            ],
        ];
    }
}
