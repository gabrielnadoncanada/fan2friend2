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
use Tymon\JWTAuth\Facades\JWTAuth;

class WaitingRoomComponent extends Component
{
    public $user;

    public $isWithinEvent = false;

    protected $listeners = ['refreshWaitingRoom' => '$refresh'];

    public int $currentPosition = 0;

    public Celebrity $celebrity;

    public $orderItem;

    public string $enteredAt;

    public $waitingRoomEntry;

    public $currentDate;

    public function mount()
    {
        $this->user = Auth::user();
        $this->enteredAt = now();
        $this->currentDate = now()->format('Y-m-d');
        $this->orderItem = false;

        $scheduleRuleExceptionForCurrentDate = $this->celebrity->scheduleRuleExceptions()->where('date', $this->currentDate)->first();

        if ($scheduleRuleExceptionForCurrentDate) {
            $interval = $scheduleRuleExceptionForCurrentDate->intervals()
                ->where('start_time', '<', now()->format('H:i'))
                ->where('end_time', '>', now()->format('H:i'))
                ->first();

            if ($interval) {
                $this->orderItem = $this->getActiveOrderItemForCurrentCelebrityInterval();
            }
        } else {
            $scheduleRuleForCurrentDate = $this->celebrity->scheduleRules()->where('wday', now()->format('l'))->first();
            $interval = $scheduleRuleForCurrentDate->intervals()
                ->where('start_time', '<', now()->format('H:i'))
                ->where('end_time', '>', now()->format('H:i'))
                ->first();
            if ($interval) {
                $this->orderItem = $this->getActiveOrderItemForCurrentCelebrityInterval();
            }
        }
        $this->orderItem = $this->getActiveOrderItemForCurrentCelebrityInterval($interval);
        $this->updateWaitingRoomEntry();
        $this->setWaitingRoomPosition();
        if ($this->orderItem) {

        } else {

            //            $this->redirect(route('celebrity.index'));
        }
    }

    private function getActiveOrderItemForCurrentCelebrityInterval()
    {
        return OrderItem::where('celebrity_id', $this->celebrity->id)
            ->where('scheduled_date', $this->currentDate)
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.user_id', $this->user->id)
            ->where('order_items.status', OrderStatus::PAID)->first();
    }

    private function updateWaitingRoomEntry()
    {
        $this->waitingRoomEntry = WaitingRoom::updateOrCreate(
            [
                'celebrity_id' => $this->celebrity->id,
                'user_id' => $this->user->id,
                'status' => WaitingRoomStatus::WAITING,
                'order_item_id' => $this->orderItem->id,
            ],
            [
                'entered_at' => $this->enteredAt,
            ]
        );
    }

    public function setWaitingRoomPosition()
    {
        $waitingRoomEntries = WaitingRoom::where('celebrity_id', $this->celebrity->id)
            ->where('status', WaitingRoomStatus::WAITING)
            ->orWhere('status', WaitingRoomStatus::IN_SESSION)
            ->orderBy('entered_at', 'asc')
            ->get();

        foreach ($waitingRoomEntries as $index => $entry) {
            if ($entry->order_item_id === $this->orderItem->id) {
                $this->currentPosition = $index + 1;

                break;
            }
        }
    }

    public function joinMeeting()
    {
        $customClaims = [
            'iss' => 'my_jitsi_app_id',
            'aud' => 'localhost:8443',
            'room' => '*',
            'context' => [
                'user' => [
                    'name' => $this->user->full_name,
                    'email' => $this->user->email,
                ],
            ],
            //            'exp' => Carbon::now()->addSeconds(15)->timestamp, //
        ];

        $token = JWTAuth::customClaims($customClaims)->fromUser($this->user);

        $this->waitingRoomEntry->update(['status' => WaitingRoomStatus::IN_SESSION]);

        $this->redirect(route('celebrity.meeting', [
            'celebrity' => $this->celebrity,
            'token' => $token,
        ]));
    }

    public function render()
    {
        return view('livewire.celebrity.waiting-room');
    }
}
