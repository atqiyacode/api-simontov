<?php

namespace App\Models;

use App\Filters\FailedJobFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class FailedJob extends Model
{
    use HasFactory, Filterable;

    protected string $default_filters = FailedJobFilters::class;

    protected $table = 'logs';

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [];
}
