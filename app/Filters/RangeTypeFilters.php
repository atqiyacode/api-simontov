<?php

namespace App\Filters;

use Essa\APIToolKit\Filters\QueryFilters;

class RangeTypeFilters extends QueryFilters
{
    public function trashed($term)
    {
        $params = $this->convertStringToBoolean($term);
        $this->builder->where(function ($query) use ($params) {
            $query->when($params, function ($query) {
                $query->whereNotNull('deleted_at');
            }, function ($query) {
                $query->whereNull('deleted_at');
            });
        });
    }

    private function convertStringToBoolean($value)
    {
        $lowercaseValue = strtolower($value);

        if ($lowercaseValue === 'true' || $lowercaseValue === '1') {
            return true;
        } elseif ($lowercaseValue === 'false' || $lowercaseValue === '0') {
            return false;
        }
        return null;
    }
    protected array $allowedFilters = [
        'slug',
        'label',
        'lower_limit',
        'upper_limit',
        'description',
    ];

    protected array $columnSearch = [
        'slug',
        'label',
        'lower_limit',
        'upper_limit',
        'description',
    ];

    protected array $allowedSorts = [
        'id',
        'slug',
        'label',
        'lower_limit',
        'upper_limit',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
