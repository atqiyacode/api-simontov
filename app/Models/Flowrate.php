<?php

namespace App\Models;

use App\Filters\FlowrateFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\CanDeleteScope;

class Flowrate extends Model
{
    use HasFactory, Filterable, SoftDeletes, CanDeleteScope;

    protected string $default_filters = FlowrateFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'location_id',
        'mag_date',
        'flowrate',
        'unit_flowrate',
        'totalizer_1',
        'totalizer_2',
        'totalizer_3',
        'unit_totalizer',
        'analog_1',
        'analog_2',
        'status_battery',
        'alarm',
        'bin_alarm',
        'file_name',
        'ph',
        'cod',
        'cond',
        'level',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'mag_date' => 'datetime',
    ];

    public function getBin()
    {
        return strrev($this->bin_alarm);
    }

    public function location(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Location::class);
    }
}
