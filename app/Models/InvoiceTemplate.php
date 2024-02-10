<?php

namespace App\Models;

use App\Filters\InvoiceTemplateFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class InvoiceTemplate extends Model
{
    use HasFactory, Filterable;

    protected string $default_filters = InvoiceTemplateFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'company_name',
		'company_address',
		'phone',
		'fax',
		'npwp',
		'additional_section',
		'manager_name',
		'note',
    ];


}
