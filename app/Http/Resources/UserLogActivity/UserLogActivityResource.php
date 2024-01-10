<?php

namespace App\Http\Resources\UserLogActivity;

use Illuminate\Http\Resources\Json\JsonResource;

class UserLogActivityResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,


            'trashed' => $this->when(auth()->check() && auth()->user()->hasAnyRole(['superman']), function () {
                return (bool) $this->deleted_at;
            }),
        ];
    }
}
