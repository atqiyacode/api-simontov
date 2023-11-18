<?php

namespace App\Http\Resources\User;

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
            'username' => $this->username,
            'email' => $this->email,
            'is_verified' => (bool) $this->email_verified_at,
            'avatar' => $this->avatar_image,
            'roles' => $this->roles->pluck('name'),

            'locations' => $this->locations->pluck('id'),
            'dashboardCharts' => $this->dashboardCharts->pluck('code'),
            // 'permissions' => $this->permissions->pluck('name'),
            'newEmail' => (bool) $this->getPendingEmail(),
            'pendingEmail' => $this->getPendingEmail(),
            'issuperadmin' => auth()->user()->hasAnyRole(['superadmin']),
        ];
    }
}
