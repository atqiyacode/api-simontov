<?php

namespace App\Filters;

use Essa\APIToolKit\Filters\QueryFilters;

class UserFilters extends QueryFilters
{
    protected array $allowedFilters = [];

    protected array $columnSearch = [
        'name',
        'username',
        'email',
    ];

    protected array $allowedSorts = [
        'id',
        'name',
        'username',
        'email',
    ];
}
