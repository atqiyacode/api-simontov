<?php

namespace App\Models\v1;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MobileAppMenu extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'name_en',
        'description',
        'description_en',
        'icon',
        'mobile_status_id'
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

    public function status(): BelongsTo
    {
        return $this->belongsTo(MobileStatus::class, 'mobile_status_id', 'id');
    }
}
