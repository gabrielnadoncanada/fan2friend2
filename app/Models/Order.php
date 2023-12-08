<?php

namespace App\Models;

use App\Enums\CanadianProvince;
use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'status',
        'notes',
    ];

    protected $casts = [
        'status' => OrderStatus::class,
        'state' => CanadianProvince::class,

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function getTotalAttribute()
    {
        return $this->orderItems->sum('price');
    }

    protected static function booted()
    {
        static::deleted(function ($order) {
            Cache::forget("celebrity.{$order->celebrity_id}.availabilities");
        });

        static::updated(function ($order) {
            Cache::forget("celebrity.{$order->celebrity_id}.availabilities");
        });

        static::created(function ($order) {
            Cache::forget("celebrity.{$order->celebrity_id}.availabilities");
        });
    }
}
