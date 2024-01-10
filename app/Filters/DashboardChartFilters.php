<?php

namespace App\Filters;

use Essa\APIToolKit\Filters\QueryFilters;

class DashboardChartFilters extends QueryFilters
{
    protected array $allowedFilters = [
        'status'
    ];

    protected array $allowedSorts = [
        'id',
        'name',
    ];

    protected array $columnSearch = [
        'code',
        'name',
    ];
}
