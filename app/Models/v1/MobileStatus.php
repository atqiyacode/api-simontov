<?php

namespace App\Models\v1;

use Cviebrock\EloquentSluggable\Sluggable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MobileStatus extends Model
{
    use HasFactory, Sluggable, Loggable, SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function scopeCanDelete($query)
    {
        $query->when(auth()->user()->hasAnyRole(['privateAccess']), function ($q) {
            return $q->withTrashed();
        });
    }

    public function scopeActive($query)
    {
        return $query->where('name', 'active');
    }
    public function scopeInactive($query)
    {
        return $query->where('name', 'inactive');
    }
    public function scopeMaintenance($query)
    {
        return $query->where('name', 'maintenance');
    }
}
