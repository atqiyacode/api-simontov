<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MobileVersionResource extends JsonResource
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
            'slug' => $this->slug,
            'code' => $this->code,
            'name' => $this->name,
            'note' => $this->note,
            'app_file' => $this->app_file,
            'release_url' => $this->release_url,
            'device' => new MobileDeviceTypeResource($this->device),
            'status' => new MobileStatusResource($this->status),
            'build' => new MobileBuildTypeResource($this->build),
            'trashed' => (bool) $this->deleted_at,
        ];
    }
}
