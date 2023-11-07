<?php

namespace App\Livewire;

use App\Events\WaitingRoomUpdated;
use App\Models\User;
use App\Models\WaitingRoom;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class WaitingRoomComponent extends Component
{
    public $waitingRoomEntries;
    public $waitingRoomEntry;
    public $userId;
    public $currentPosition;


    protected $listeners = ['refreshWaitingRoom' => '$refresh'];

    public function mount($userId = null)
    {
        $this->userId = $userId ?? Auth::id();





        $this->loadWaitingRoomEntries();
        $this->calculatePosition();
    }

    private function initializeCustomer()
    {
        $customer = Customer::where('user_id', $this->userId)->first();
        if (!$customer) {
            session()->flash('error', 'Customer not found.');
            return false;
        }

        $this->checkForNewOrderItem($customer);
        return true;
    }

    public function loadWaitingRoomEntries()
    {
        $this->waitingRoomEntries = WaitingRoom::with('orderItem.order.customer.user')
            ->where('status', 'waiting')
            ->get();
    }

    public function calculatePosition()
    {
        // Retrieve the user's Customer record
        $customer = User::find($this->userId)->customer;
        if (!$customer) {
            $this->currentPosition = null;
            return;
        }

        // Get all the waiting room entries before the customer's earliest entry
        $earliestEntry = WaitingRoom::whereHas('orderItem.order', function ($query) use ($customer) {
            $query->where('customer_id', $customer->id);
        })->oldest('entered_at')->first();

        if ($earliestEntry) {
            // Now count all the entries that came before the user's earliest entry
            $this->currentPosition = WaitingRoom::where('status', 'waiting')
                ->where('entered_at', '<=', $earliestEntry->entered_at)
                ->count();
        } else {
            // If the user has no entry, their position is not applicable
            $this->currentPosition = null;
        }
    }

//    public function pollPresence()
//    {
//        cache()->put('user-last-seen-' . $this->userId, now(), 60);
//    }
//
//    private function checkForNewOrderItem(Customer $customer)
//    {
//        $latestOrderItem = $customer->latestOrderItem; // Assuming this is a defined relationship
//
//        if (!$latestOrderItem || !$latestOrderItem->timeSlot || !$latestOrderItem->timeSlot->weeklySchedule) {
//            return;
//        }
//
//        $currentTime = now();
//        if ($this->isCurrentTimeInOrderItemSlot($latestOrderItem, $currentTime)) {
//            $this->updateOrCreateWaitingRoomEntry($latestOrderItem);
//        }
//    }
//
//    private function isCurrentTimeInOrderItemSlot($orderItem, $currentTime)
//    {
//        $timeSlot = $orderItem->timeSlot;
//        $timeSlotStart = Carbon::createFromTimeString($timeSlot->start_time);
//        $timeSlotEnd = Carbon::createFromTimeString($timeSlot->end_time);
//
//        return $currentTime->dayOfWeek === $timeSlot->weeklySchedule->day_of_week &&
//            $currentTime->between($timeSlotStart, $timeSlotEnd, true);
//    }
//
//    private function updateOrCreateWaitingRoomEntry($orderItem)
//    {
//        $completedWaitingRoomEntry = WaitingRoom::where('order_item_id', $orderItem->id)
//            ->where('status', 'completed')
//            ->first();
//
//        if (!$completedWaitingRoomEntry) {
//            $this->waitingRoomEntry = WaitingRoom::updateOrCreate(
//                ['order_item_id' => $orderItem->id],
//                ['status' => 'waiting', 'entered_at' => now()]
//            );
//        }
//    }
//

//
//    public function getListeners()
//    {
//        return ['echo:waiting-room,WaitingRoomUpdated' => 'handle'];
//    }
//
//    public function calculatePosition()
//    {
//        // Retrieve the user's Customer record
//        $customer = User::find($this->userId)->customer;
//        if (!$customer) {
//            $this->currentPosition = null;
//            return;
//        }
//
//        // Get all the waiting room entries before the customer's earliest entry
//        $earliestEntry = WaitingRoom::whereHas('orderItem.order', function ($query) use ($customer) {
//            $query->where('customer_id', $customer->id);
//        })->oldest('entered_at')->first();
//
//        if ($earliestEntry) {
//            // Now count all the entries that came before the user's earliest entry
//            $this->currentPosition = WaitingRoom::where('status', 'waiting')
//                ->where('entered_at', '<=', $earliestEntry->entered_at)
//                ->count();
//        } else {
//            // If the user has no entry, their position is not applicable
//            $this->currentPosition = null;
//        }
//    }
//
//    public function handle()
//    {
//        // Handle the event, e.g., refresh data
//        $this->loadWaitingRoomEntries();
//    }
//
//    #[On('removeFromWaitingRoom')]
//    public function removeFromWaitingRoom()
//    {
//        // Implement the logic to remove the user from the waiting room
//        $this->waitingRoomEntry->delete();
//        event(new WaitingRoomUpdated());
//
//    }

    public function render()
    {
        return view('livewire.waiting-room')->layout('components.layouts.waitingroom');
    }
}

