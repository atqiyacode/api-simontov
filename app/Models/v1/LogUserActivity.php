<?php

namespace App\Models\v1;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class LogUserActivity extends Model
{
    protected $table = 'logs';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'log_date',
        'table_name',
        'log_type',
        'data',
    ];

    protected $casts = [
        'log_date' => 'datetime',
    ];

    public function getDateHumanizeAttribute()
    {
        return Carbon::parse($this->log_date)->diffForHumans();
    }

    public function getJsonDataAttribute()
    {
        return json_decode($this->data, true);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select(['id', 'name']);
    }

    public function current($id)
    {
        return DB::table($this->table_name)->find($id);
    }

    public function scopeCurrentUser($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }
}
