<?php

namespace App\Models;

use App\Filters\RangeTypeFilters;
use Cviebrock\EloquentSluggable\Sluggable;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\CanDeleteScope;

class RangeType extends Model
{
    use HasFactory, Filterable, Sluggable, SoftDeletes, CanDeleteScope;

    protected string $default_filters = RangeTypeFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'label',
        'lower_limit',
        'upper_limit',
        'description',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'label'
            ]
        ];
    }
}
