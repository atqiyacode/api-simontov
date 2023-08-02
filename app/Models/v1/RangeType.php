<?php

namespace App\Models\v1;

use Cviebrock\EloquentSluggable\Sluggable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RangeType extends Model
{
    use HasFactory, SoftDeletes, Loggable, Sluggable;

    protected $fillable = [
        'slug',
        'label',
        'lower_limit',
        'upper_limit',
        'description',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
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
        $query->when(auth()->user()->hasAnyRole(['superadmin']), function ($q) {
            return $q->withTrashed();
        });
    }
}
