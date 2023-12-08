<?php

namespace App\Models;

use App\Casts\TimeCast;
use App\Enums\WeekDays;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ScheduleRuleException extends Model
{
    use HasFactory;

    protected $casts = [
        'start_time' => TimeCast::class,
        'end_time' => TimeCast::class,
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
        static::deleted(function ($scheduleRuleException) {
            Cache::forget("celebrity.{$scheduleRuleException->celebrity_id}.availabilities");
        });

        static::updated(function ($scheduleRuleException) {
            Cache::forget("celebrity.{$scheduleRuleException->celebrity_id}.availabilities");
        });

        static::created(function ($scheduleRuleException) {
            Cache::forget("celebrity.{$scheduleRuleException->celebrity_id}.availabilities");
        });
    }
}
