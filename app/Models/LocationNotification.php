<?php

namespace App\Models;

use App\Filters\LocationNotificationFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LocationNotification extends Model
{
    use HasFactory, Filterable;

    protected string $default_filters = LocationNotificationFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'location_id',
        'alert_notification_type_id',
        'message',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function location(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Location::class);
    }

    public function alertNotificationType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\AlertNotificationType::class)->select(['id', 'name', 'job_event', 'description']);
    }
}
