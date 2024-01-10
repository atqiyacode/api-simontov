<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait SuperAdminScope
{
    public function scopeSuperAdmin(Builder $query)
    {
        $query->when(auth()->check() && auth()->user()->hasAnyRole('superadmin'), function ($q) {
            return $q->withTrashed();
        });
    }
}
