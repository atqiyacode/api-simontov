<?php

namespace App\Filters;

use Essa\APIToolKit\Filters\QueryFilters;

class TaxFilters extends QueryFilters
{
    protected array $allowedFilters = [];

    // protected array $columnSearch = ['name', 'description'];

    // protected array $relationSearch = [
    //     'user' => ['first_name', 'last_name']
    // ];
}
