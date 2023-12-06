<?php

namespace App\Models;

use App\Enums\WaitingRoomStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaitingRoom extends Model
{
    use HasFactory;

    protected $casts = [

        'status' => WaitingRoomStatus::class
    ];
}
