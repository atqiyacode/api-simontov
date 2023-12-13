<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait IsActiveScope
{
    public function scopeIsActive(Builder $query)
    {
        return $query->where('status', true);
    }
}
