<?php

namespace App\Models\v1;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use HasFactory, SoftDeletes, Loggable;

    protected $fillable = [
        'code',
        'name',
        'lng',
        'lat',
        'description'
    ];

    public function scopeCanDelete($query)
    {
        $query->when(auth()->user()->hasAnyRole(['superadmin']), function ($q) {
            return $q->withTrashed();
        });
    }
}
