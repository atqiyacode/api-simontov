<?php

namespace App\Models\v1;

use App\Models\User;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class GlobalNotification extends Model
{
    use HasFactory, Loggable, SoftDeletes;

    protected $fillable = [
        'user_id',
        'notification_type_id',
        'message',
        'label',
    ];

    public function scopeCanDelete($query)
    {
        $query->when(auth()->user()->hasAnyRole(['privateAccess']), function ($q) {
            return $q->withTrashed();
        });
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(NotificationType::class, 'notification_type_id', 'id')->select(['id', 'slug', 'name']);
    }

    public function sender(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id')->select(['id', 'name', 'username']);
    }

    public function user(): HasMany
    {
        return $this->hasMany(GlobalNotificationUser::class, 'global_notification_id', 'id');
    }

    public function getShortMessageAttribute()
    {
        return Str::words($this->message, '10');
    }
}
