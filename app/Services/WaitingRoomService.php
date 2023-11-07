<?php

namespace App\Services;

use App\Models\WaitingRoom;
use Carbon\Carbon;

class WaitingRoomService
{
    public function enterRoom($orderItemId)
    {
        return WaitingRoom::create([
            'order_item_id' => $orderItemId,
            'status' => 'waiting',
            'entered_at' => Carbon::now(),
        ]);
    }

    public function startSession($waitingRoomId)
    {
        $waitingRoomEntry = WaitingRoom::find($waitingRoomId);
        $waitingRoomEntry->update([
            'status' => 'in_session',
            'session_started_at' => Carbon::now(),
        ]);

        // Dispatch event to notify the system of the status change, e.g. using Laravel's event system
    }

    public function endSession($waitingRoomId)
    {
        $waitingRoomEntry = WaitingRoom::find($waitingRoomId);
        $waitingRoomEntry->update([
            'status' => 'completed',
            'session_ended_at' => Carbon::now(),
        ]);

        // Dispatch event to notify the system of the status change, e.g. using Laravel's event system
    }

    // Add other methods as needed for managing the waiting room
}
