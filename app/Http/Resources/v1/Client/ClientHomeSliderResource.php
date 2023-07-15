<?php

namespace App\Http\Resources\v1\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientHomeSliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 'title' => app()->getLocale() === 'en' ? $this->title_en : $this->title,
            // 'description' => app()->getLocale() === 'en' ? $this->description_en : $this->description,
            'cover' => $this->cover,
            'url' => $this->url,
        ];
    }
}
