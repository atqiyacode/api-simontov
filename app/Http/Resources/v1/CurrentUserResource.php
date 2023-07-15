<?php

namespace App\Http\Resources\v1;

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
            'email' => Str::contains($this->email, ['@fakemail.com']) ? null : $this->email,
            'phone' => Str::replaceFirst('62', '0', $this->phone),
            'avatar' => $this->avatar_image,
            'roles' => $this->roles->pluck('name'),
            'permissions' => $this->permissions->pluck('name'),
            'newEmail' => (bool) $this->getPendingEmail(),
            'pendingEmail' => $this->getPendingEmail(),
            'notifications' => $this->unread_notifications->count(),
            'say_hello' => $this->greeting . $this->name,
        ];
    }
}
