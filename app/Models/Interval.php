<?php

namespace App\Models;

use App\Casts\TimeCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Interval extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time', 'end_time',
    ];

    protected $casts = [
        'start_time' => TimeCast::class,
        'end_time' => TimeCast::class,
    ];

    public function scheduleRules()
    {
        return $this->morphedByMany(ScheduleRule::class, 'associable', 'interval_associations');
    }

    public function scheduleRuleExceptions()
    {
        return $this->morphedByMany(ScheduleRuleException::class, 'associable', 'interval_associations');
    }

    public function celebrityThroughScheduleRule()
    {
        return $this->scheduleRule->celebrity();
    }

    public function celebrityThroughScheduleRuleException()
    {
        return $this->scheduleRuleException->celebrity();
    }

    protected static function booted()
    {
//        static::deleted(function ($interval) {
//            Cache::forget("celebrity.{$interval->celebrityThroughScheduleRule->id}.availabilities");
//            Cache::forget("celebrity.{$interval->celebrityThroughScheduleRuleException->id}.availabilities");
//        });
//
//        static::updated(function ($interval) {
//            Cache::forget("celebrity.{$interval->celebrityThroughScheduleRule->id}.availabilities");
//            Cache::forget("celebrity.{$interval->celebrityThroughScheduleRuleException->id}.availabilities");
//        });
//
//        static::created(function ($interval) {
//            Cache::forget("celebrity.{$interval->celebrityThroughScheduleRule->id}.availabilities");
//            Cache::forget("celebrity.{$interval->celebrityThroughScheduleRuleException->id}.availabilities");
//        });
    }

}
