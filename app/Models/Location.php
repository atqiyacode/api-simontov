<?php

namespace App\Models;

use App\Filters\LocationFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\CanDeleteScope;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Location extends Model
{
    use HasFactory, Filterable, SoftDeletes, CanDeleteScope;

    protected string $default_filters = LocationFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'company_name',
        'name',
        'longitude',
        'lattitude',
        'description',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    /**
     * The users that belong to the Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get all of the flowartes for the Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function flowrates(): HasOne
    {
        return $this->hasOne(Flowrate::class)->orderBy('id', 'desc');
    }
}
