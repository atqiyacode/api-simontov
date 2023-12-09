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

        'totalizer_1',
        'totalizer_2',
        'totalizer_3',

        'unit_flowrate',
        'unit_totalizer',

        'flowrate',
        'pressure',

        'analog_1',
        'status_battery',
        'alarm',

        'bin_alarm',

        'file_name',

        'ph',
        'cod',
        'cond',
        'level',
        'do',

        'do_alarm_hi',
        'do_alarm_lo',
        'pres_alarm_hi',
        'pres_alarm_lo',
        'ph_alarm_hi',
        'ph_alarm_lo',

        'fm_status',
        'fm_err_code',

        'pln_stat',
        'panel_stat',

        'created_at',
        'updated_at',

        'log_data'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'mag_date' => 'datetime:Y-m-d H:i:s',
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
