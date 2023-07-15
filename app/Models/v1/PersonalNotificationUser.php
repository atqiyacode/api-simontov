<?php

namespace App\Models\v1;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonalNotificationUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'personal_notification_id',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function notification(): BelongsTo
    {
        return $this->belongsTo(PersonalNotification::class, 'personal_notification_id', 'id');
    }

    public function scopeCurrentUser($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    public function scopeNotRead($query)
    {
        return $query->where('status', false);
    }
}
