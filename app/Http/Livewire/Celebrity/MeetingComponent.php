<?php

namespace App\Http\Livewire\Celebrity;

use App\Enums\OrderStatus;
use App\Enums\WaitingRoomStatus;
use App\Models\Celebrity;
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

        $this->waitingRoomEntry = $this->getUserWaitingRoomEntry();

        if (
            (
                $this->waitingRoomEntry
            && $this->waitingRoomEntry->status === WaitingRoomStatus::IN_SESSION
            && $this->waitingRoomEntry->orderItem->status === OrderStatus::PAID
            ) || $this->user->hasRole('Host')
        ) {
            $this->waitingRoomEntry->update([
                'session_started_at' => now()->format('Y-m-d H:i:s'),
            ]);
            $this->meetingUrl = 'https://localhost:8443/' . $this->celebrity->slug . '?jwt=' . $this->token;
        } else {
            //            $this->redirect(route('celebrity.index'));
        }
    }

    private function getUserWaitingRoomEntry()
    {
        return $this->waitingRoomEntry = WaitingRoom::where('celebrity_id', $this->celebrity->id)
            ->where('user_id', $this->user->id)
            ->where('status', WaitingRoomStatus::IN_SESSION)->first();
    }

    public function checkMeetingTime()
    {
        $currentTime = Carbon::now();

        $endTime = Carbon::parse($this->waitingRoomEntry->session_started_at)->addMinutes($this->waitingRoomEntry->orderItem->duration);

        if ($currentTime > $endTime && ! $this->user->hasRole('Host')) {
            $this->isTimeCollapsed = true;
            $this->waitingRoomEntry->update([
                'status' => WaitingRoomStatus::COMPLETED,
            ]);

            $this->waitingRoomEntry->orderItem->update([
                'status' => OrderStatus::DELIVERED,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.celebrity.meeting')->layout('layouts.blank');
    }
}
