<?php

namespace App\Filters;

use Essa\APIToolKit\Filters\QueryFilters;

class FlowrateFilters extends QueryFilters
{
    protected array $allowedFilters = [
        'location_id'
    ];

    protected array $allowedSorts = [
        'id',
        'ph',
        'cod',
        'cond',
        'level',
        'totalizer_1',
        'totalizer_2',
        'totalizer_3',
        'analog_1',
        'analog_2',
        'alarm',
        'flowrate',
        'created_at'
    ];

    protected array $columnSearch = [
        'ph',
        'cod',
        'cond',
        'level',
        'totalizer_1',
        'totalizer_2',
        'totalizer_3',
        'analog_1',
        'analog_2',
        'alarm',
        'flowrate',
    ];

    protected array $relationSearch = [
        'location' => ['name']
    ];

    protected array $allowedIncludes = ['location'];
}
