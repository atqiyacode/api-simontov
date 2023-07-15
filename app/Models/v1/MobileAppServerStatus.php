<?php

namespace App\Models\v1;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileAppServerStatus extends Model
{
    use HasFactory, Loggable;

    protected $fillable = [
        'status'
    ];
}
