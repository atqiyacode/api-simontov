<?php

namespace App\Models;

use App\Filters\LocationFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\CanDeleteScope;

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
     * The users that belong to the Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
