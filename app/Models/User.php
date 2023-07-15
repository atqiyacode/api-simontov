<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
// use Laravel\Sanctum\HasApiTokens;
use ProtoneMedia\LaravelVerifyNewEmail\MustVerifyNewEmail;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Loggable, HasRoles, HasPermissions, MustVerifyNewEmail, SoftDeletes;

    protected $guard_name  = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'avatar',
        'phone',
        'pin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getAvatarImageAttribute()
    {
        return $this->avatar ?? (new \Laravolt\Avatar\Avatar)->create($this->name)
            ->setDimension(150)
            ->toBase64();
    }

    public function getGreetingAttribute()
    {
        $greetings = "";

        $time = date("H");

        $timezone = date("e");

        if ($time < "12") {
            $greetings = trans('client.good_morning');
        } elseif ($time >= "12" && $time < "17") {
            $greetings = trans('client.good_afternoon');
        } elseif ($time >= "17" && $time < "19") {
            $greetings = trans('client.good_evening');
        } elseif ($time >= "19") {
            $greetings = trans('client.good_night');
        } else {
            $greetings = trans('client.welcome');
        }

        return $greetings;
    }

    public function scopeActive($query)
    {
        return $query->where('email_verified_at', '!=', null);
    }

    public function scopeHasEmail($query)
    {
        return $query->where('email', '!=', null)->where('email', 'NOT LIKE', "%@fakemail.com%");
    }

    public function scopeHasPhone($query)
    {
        return $query->where('phone', '!=', null);
    }

    public function scopePrivate($query)
    {
        $query->when(!auth()->user()->hasRole(['developer']), function ($q) {
            return $q->where('email', '!=', 'atqiya@atqiyacode.com')->where('email', '!=', 'jeksi@sentralnusa.com');
        });
    }

    public function scopeNotCurrent($query)
    {
        return $query->where('email', '!=', auth()->user()->email);
    }

    public function scopeVerified($query)
    {
        return $query->whereNotNull('email_verified_at');
    }

    public function scopeNotVerified($query)
    {
        return $query->whereNull('email_verified_at');
    }

    public function scopeCanDelete($query)
    {
        $query->when(auth()->user()->hasAnyRole(['developer', 'superadmin']), function ($q) {
            return $q->withTrashed();
        });
    }

    // public function unread_notifications(): HasMany
    // {
    //     return $this->hasMany(GlobalNotificationUser::class, 'user_id', 'id')
    //         ->where('user_id', auth()->user()->id)
    //         ->where('status', false);
    // }

    // public function firebaseToken(): HasOne
    // {
    //     return $this->hasOne(UserFirebaseToken::class, 'user_id', 'id');
    // }
}
