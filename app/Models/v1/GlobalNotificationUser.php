<?php

namespace App\Models\v1;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GlobalNotificationUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'global_notification_id',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function notification(): BelongsTo
    {
        return $this->belongsTo(GlobalNotification::class, 'global_notification_id', 'id');
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
