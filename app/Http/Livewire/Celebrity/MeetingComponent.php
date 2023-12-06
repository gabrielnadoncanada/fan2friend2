<?php

namespace App\Http\Livewire\Celebrity;

use App\Enums\OrderStatus;
use App\Enums\WaitingRoomStatus;
use App\Models\Celebrity;
use App\Models\OrderItem;
use App\Models\WaitingRoom;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MeetingComponent extends Component
{
    // ... existing properties ...
    public $user;

    public $isWithinEvent = false;

    public Celebrity $celebrity;

    public $orderItem;

    public string $currentDate;

    public $waitingRoomEntry;

    public $meetingUrl;

    public $isTimeCollapsed = false;

    public $token;

    public $room;

    public function mount()
    {
        $this->user = Auth::user();

        dd($this);




//        $this->orderItem = $this->getActiveOrderItemForCurrentCelebrity();
//
//        if ($this->orderItem) {
//            $this->updateWaitingRoomEntry();
//        }
    }

//    private function getActiveOrderItemForCurrentCelebrity()
//    {
//        return OrderItem::where('celebrity_id', $this->celebrity->id)
//            ->where('scheduled_date', $this->currentDate)
//            ->join('orders', 'orders.id', '=', 'order_items.order_id')
//            ->where('orders.user_id', $this->user->id)
//            ->where('order_items.status', OrderStatus::PAID)->first();
//    }
//
//    private function checkMeetingStatus()
//    {
//        if (isset($this->waitingRoomEntry->meeting_url)) {
//            $this->meetingUrl = $this->waitingRoomEntry->meeting_url;
//        }
//    }
//
//
//    private function updateWaitingRoomEntry()
//    {
//        $this->waitingRoomEntry = WaitingRoom::updateOrCreate(
//            [
//                'order_item_id' => $this->orderItem->id,
//                'celebrity_id' => $this->celebrity->id,
//                'start_time' => $this->orderItem->start_time,
//                'scheduled_date' => $this->orderItem->scheduled_date,
//            ],
//            [
//                'status' => WaitingRoomStatus::IN_SESSION,'end_time' => now()
//            ]
//        );
//    }
//
//
//    public function checkMeetingTime()
//    {
//        $startTime = Carbon::parse($this->waitingRoomEntry->entered_at);
//        $endTime = Carbon::parse($this->waitingRoomEntry->entered_at)->addMinutes($this->orderItem->duration);
//
//        if ($startTime > $endTime) {
//            $this->isTimeCollapsed = true;
//            $this->waitingRoomEntry->update([
//                'status' => WaitingRoomStatus::COMPLETED,
//                'session_ended_at' => now(),
//            ]);
//        }
//    }
//
    public function render()
    {
        return view('livewire.celebrity.meeting')->layout('layouts.blank');
    }
}
