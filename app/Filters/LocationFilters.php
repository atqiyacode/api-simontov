<?php

namespace App\Filters;

use Essa\APIToolKit\Filters\QueryFilters;

class LocationFilters extends QueryFilters
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
        'code',
        'company_name',
        'name',
        'longitude',
        'lattitude',
        'description',
        'npwp',
        'email',
        'pic',
        'address',
    ];

    protected array $columnSearch = [
        'code',
        'company_name',
        'name',
        'longitude',
        'lattitude',
        'description',
        'npwp',
        'email',
        'pic',
        'address',
    ];

    protected array $allowedSorts = [
        'id',
        'code',
        'company_name',
        'name',
        'longitude',
        'lattitude',
        'description',
        'npwp',
        'email',
        'pic',
        'address',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
