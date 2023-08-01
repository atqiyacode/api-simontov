<?php

namespace App\Models\v1;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RangeCost extends Model
{
    use HasFactory, SoftDeletes, Loggable;

    protected $fillable = [
        'value',
        'range_type_id',
    ];

    public function scopeCanDelete($query)
    {
        $query->when(auth()->user()->hasAnyRole(['superadmin']), function ($q) {
            return $q->withTrashed();
        });
    }

    /**
     * Get the type that owns the RangeCost
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(RangeType::class, 'range_type_id', 'id');
    }
}
