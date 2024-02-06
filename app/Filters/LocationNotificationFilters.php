<?php

namespace App\Filters;

use Essa\APIToolKit\Filters\QueryFilters;

class LocationNotificationFilters extends QueryFilters
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
        'alert_notification_type_id',
        'location_id',
    ];

    protected array $columnSearch = [
        'alert_notification_type_id',
        'location_id',
    ];

    protected array $allowedSorts = [
        'id',
        'alert_notification_type_id',
        'location_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
