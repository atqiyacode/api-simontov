<?php

namespace App\Http\Resources\v1\Client;

use App\Http\Resources\v1\MobileStatusResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Browser;

class ClientHomeMenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'code' => $this->code,
            'name' => app()->getLocale() === 'en' ? $this->name_en : $this->name,
            'description' => app()->getLocale() === 'en' ? $this->description_en : $this->description,
            'icon' => $this->icon,
            'status' => new MobileStatusResource($this->status),
            'locale' => app()->getLocale(),
        ];
    }
}
