<?php

namespace App\Filters;

use Essa\APIToolKit\Filters\QueryFilters;

class LocationFilters extends QueryFilters
{
    protected array $allowedFilters = [];

    protected array $columnSearch = [
        'code',
        'name',
        'company_name',
    ];

    protected array $allowedSorts = [
        'id',
        'code',
        'name',
        'company_name',
    ];
}
