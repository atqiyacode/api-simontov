<?php

namespace App\Models\v1;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeSlider extends Model
{
    use HasFactory, Loggable, SoftDeletes;

    protected $fillable = [
        'title',
        'title_en',
        'description',
        'description_en',
        'cover',
        'url',
        'status',
    ];

    public function scopeCanDelete($query)
    {
        $query->when(auth()->user()->hasAnyRole(['privateAccess']), function ($q) {
            return $q->withTrashed();
        });
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', true);
    }
}
