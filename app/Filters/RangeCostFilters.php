<?php

namespace App\Filters;

use Essa\APIToolKit\Filters\QueryFilters;

class RangeCostFilters extends QueryFilters
{
    protected array $allowedFilters = [];

    protected array $allowedSorts = [
        'id',
        'value',
        'created_at'
    ];

    protected array $columnSearch = ['value'];

    // protected array $relationSearch = [
    //     'rangeType' => ['label', 'upper_limit', 'lower_limit']
    // ];

    // protected array $allowedIncludes = ['rangeType'];
}
