<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone ? '0' . Str::substr($this->phone, 2) : null,
            'roles' => $this->roles,
            'verified' => (bool) $this->email_verified_at,
            'avatar' => $this->avatar ?? (new \Laravolt\Avatar\Avatar)->create($this->name)
                ->setDimension(150)
                ->toBase64(),
            'roles' => RoleResource::collection($this->roles),
            'permissions' => PermissionResource::collection($this->permissions),
            'join_date' => new DateFormatResource($this->created_at),
            'trashed' => (bool) $this->deleted_at,
            'newEmail' => (bool) $this->getPendingEmail(),
            'pendingEmail' => $this->getPendingEmail(),
        ];
    }
}
