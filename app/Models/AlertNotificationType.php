<?php

namespace App\Models;

use App\Filters\AlertNotificationTypeFilters;
use App\Scopes\CanDeleteScope;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlertNotificationType extends Model
{
    use HasFactory, Filterable, SoftDeletes, CanDeleteScope;

    protected string $default_filters = AlertNotificationTypeFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'job_event',
        'description',
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
}
