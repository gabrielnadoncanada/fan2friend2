<?php

namespace App\Models;

use App\Casts\TimeCast;
use App\Enums\OrderStatus;
use App\Enums\WeekDays;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time', 'duration', 'scheduled_date', 'status',
    ];

    protected $casts = [
        'start_time' => TimeCast::class,
        'wday' => WeekDays::class,
        'status' => OrderStatus::class,
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function celebrity()
    {
        return $this->belongsTo(Celebrity::class);
    }

    public function waitingRoom()
    {
        return $this->belongsTo(WaitingRoom::class);
    }

    protected static function booted()
    {
        static::deleted(function ($orderItem) {
            Cache::forget("celebrity.{$orderItem->order->celebrity_id}.availabilities");
        });

        static::updated(function ($orderItem) {
            Cache::forget("celebrity.{$orderItem->order->celebrity_id}.availabilities");
        });

        static::created(function ($orderItem) {
            Cache::forget("celebrity.{$orderItem->order->celebrity_id}.availabilities");
        });
    }
}
