<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CurrentUserResource extends JsonResource
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
            'verified' => (bool) $this->email_verified_at,
            'phone' => Str::replaceFirst('+62', '0', $this->phone),
            'avatar' => $this->avatar_image,
            'roles' => $this->roles->pluck('name'),
            'permissions' => $this->permissions->pluck('name'),
            'newEmail' => (bool) $this->getPendingEmail(),
            'pendingEmail' => $this->getPendingEmail(),
            'say_hello' => $this->greeting . $this->name,
        ];
    }
}
