<?php

namespace App\Http\Resources\v1\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientEmployeeResource extends JsonResource
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
            'full_name' => $this->full_name,
            'child' => (int) $this->child,
            'dependent' => (int) $this->dependent,
            'jamsostek' => $this->jamsostek,
            'npwp' => $this->npwp,
            'nik' => $this->nik,
            'grade' => [
                'name' => $this->grade->name
            ],
            'designation' => [
                'name' => $this->designation->name
            ],
            'department' => [
                'name' => $this->department->name
            ],
        ];
    }
}
