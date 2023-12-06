<?php

namespace App\Models;

use App\Enums\WeekDays;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ScheduleRule extends Model
{
    use HasFactory;

    protected $casts = [
        'wday' => WeekDays::class,
    ];

    public function celebrity()
    {
        return $this->belongsTo(Celebrity::class);
    }

    public function intervals()
    {
        return $this->morphToMany(Interval::class, 'associable', 'interval_associations');
    }

    protected static function booted()
    {
        static::deleted(function ($scheduleRule) {
            Cache::forget("celebrity.{$scheduleRule->celebrity_id}.availabilities");
        });

        static::updated(function ($scheduleRule) {
            Cache::forget("celebrity.{$scheduleRule->celebrity_id}.availabilities");
        });

        static::created(function ($scheduleRule) {
            Cache::forget("celebrity.{$scheduleRule->celebrity_id}.availabilities");
        });
    }
}
