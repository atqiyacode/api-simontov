<?php

namespace App\Models;

use App\Filters\DashboardChartFilters;
use App\Scopes\CanDeleteScope;
use Cviebrock\EloquentSluggable\Sluggable;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DashboardChart extends Model
{
    use HasFactory, Filterable, SoftDeletes, CanDeleteScope, Sluggable;

    protected string $default_filters = DashboardChartFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'description',
        'status',
    ];

    public function sluggable(): array
    {
        return [
            'code' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * The users that belong to the Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
