<?php

namespace App\Models\v1;

use Cviebrock\EloquentSluggable\Sluggable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MobileVersion extends Model
{
    use HasFactory, Sluggable, Loggable, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'note',
        'app_file',
        'release_url',
        'mobile_device_type_id',
        'mobile_build_type_id',
        'mobile_status_id',
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

    public function device(): BelongsTo
    {
        return $this->belongsTo(MobileDeviceType::class, 'mobile_device_type_id', 'id');
    }

    public function build(): BelongsTo
    {
        return $this->belongsTo(MobileBuildType::class, 'mobile_build_type_id', 'id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(MobileStatus::class, 'mobile_status_id', 'id');
    }
}
