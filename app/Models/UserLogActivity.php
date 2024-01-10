<?php

namespace App\Models;

use App\Filters\UserLogActivityFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserLogActivity extends Model
{
    use HasFactory, Filterable;

    protected string $default_filters = UserLogActivityFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        
    ];


}
