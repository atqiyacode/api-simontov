<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndonesiaVillageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'district' => new IndonesiaResource($this->district),
            'city' => new IndonesiaResource($this->city),
            'province' => new IndonesiaResource($this->province),
        ];
    }
}
