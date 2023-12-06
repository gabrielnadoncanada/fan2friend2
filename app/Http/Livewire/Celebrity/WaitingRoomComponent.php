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


    public function mount()
    {
        $this->user = Auth::user();
        $this->enteredAt = now();

        $this->orderItem = $this->getActiveOrderItemForCurrentCelebrity();

        if ($this->orderItem) {
            $this->updateWaitingRoomEntry();
            $this->setWaitingRoomPosition();
        }
    }

    private function getActiveOrderItemForCurrentCelebrity()
    {
        return OrderItem::where('celebrity_id', $this->celebrity->id)
            ->where('scheduled_date', now()->format('Y-m-d'))
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
            ],
            [
                'entered_at' => $this->enteredAt
            ]
        );
    }

    public function setWaitingRoomPosition()
    {
//        if ($this->currentPosition > 0) {
//            $this->currentPosition = $this->currentPosition - 1;
//        }
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
            'room' => $this->celebrity->slug,
            'token' => $token,
        ]));
    }

    public function render()
    {
        return view('livewire.celebrity.waiting-room');
    }
}
