<?php

namespace App\Models\v1;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeveloperNote extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $fillable = [
        'label',
        'content',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'label'
            ]
        ];
    }

    public function scopeCanDelete($query)
    {
        $query->when(auth()->user()->hasAnyRole(['privateAccess']), function ($q) {
            return $q->withTrashed();
        });
    }
}
