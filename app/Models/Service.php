<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function celebrity()
    {
        return $this->belongsTo(Celebrity::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
