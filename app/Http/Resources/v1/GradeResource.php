<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GradeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $list = [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
        ];
        if (auth()->user()) {
            $list['trashed'] = auth()->user()->hasRole(['privateAccess']) ?  (bool) $this->deleted_at : null;
        }

        return $list;
    }
}
