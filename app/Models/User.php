<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Filters\UserFilters;
use App\Notifications\ResetPasswordNotification;
use Essa\APIToolKit\Filters\Filterable;
use Essa\APIToolKit\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\CanDeleteScope;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Passport\HasApiTokens;
use Laravel\Sanctum\HasApiTokens;
use ProtoneMedia\LaravelVerifyNewEmail\MustVerifyNewEmail;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasRoles, HasPermissions, MustVerifyNewEmail, HasFactory, Notifiable, Filterable, SoftDeletes, CanDeleteScope;

    protected string $default_filters = UserFilters::class;

    protected $guard_name  = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
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

    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
     */
    public function sendPasswordResetNotification($token): void
    {
        // $url = 'https://example.com/reset-password?token=' . $token;
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Send a email verification notification to the user.
     */
    // public function sendEmailVerificationNotification()
    // {
    //     $this->notify(new EmailVerificationNotification);
    // }

    /**
     * The locations that belong to the Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Location::class)->with(['flowrates']);
    }

    /**
     * The dashboardCharts that belong to the Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function dashboardCharts(): BelongsToMany
    {
        return $this->belongsToMany(DashboardChart::class);
    }
}
