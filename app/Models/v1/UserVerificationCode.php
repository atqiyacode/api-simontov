<?php

namespace App\Models\v1;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVerificationCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'verification_code_type_id',
        'token_code',
        'expired_at'
    ];

    protected $casts = [
        'expired_at' => 'datetime',
    ];
}
