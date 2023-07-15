<?php

namespace App\Http\Resources\v1\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientContactResource extends JsonResource
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
            'code' => $this->code,
            'full_name' => $this->full_name,
            'grade' => [
                'name' => $this->grade->name
            ],
            'designation' => [
                'name' => $this->designation->name
            ],
            'department' => [
                'name' => $this->department->name
            ],
            'avatar' => $this->account ? $this->account->avatar_image : null,
            'has_account' => (bool) $this->account,
        ];
    }
}
