<?php

namespace App\Http\Livewire\Celebrity;

use App\Facades\Booking;
use App\Facades\Cart;
use App\Models\Celebrity;
use App\Services\BookingService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public Celebrity $celebrity;

    public $selectedDate;

    public $intervals = [];

    private $availabilities = [];

    public int $selectedIntervalId;

    public function mount(): void
    {
        $this->availabilities = Booking::fetchAvailabilitiesWithExclusions($this->celebrity);
    }

    #[On('setSelectedDate')]
    public function setSelectedDate($selectedDate, $intervals)
    {
        $this->selectedDate = Carbon::make($selectedDate)->format('Y-m-d');

        $this->reset('intervals');

        foreach ($intervals as $interval) {
            if(Booking::isIntervalAvailable($this->celebrity, $this->selectedDate, $interval['interval_id'])){
                $this->intervals[$interval['interval_id']] = [
                    'id' => $interval['interval_id'],
                    'start_time' => $interval['start_time'],
                    'end_time' => $interval['end_time'],
                ];
            }
        }
    }

    public function addToCart(): void
    {
        $this->validate([
            'selectedIntervalId' => 'required|integer',
        ]);

        Cart::add(
            $this->selectedIntervalId,
            $this->celebrity->full_name,
            $this->celebrity->price,
            1,
            [
                'celebrity_id' => $this->celebrity->id,
                'duration' => $this->celebrity->spot_step,
                'image' => $this->celebrity->image,
                'scheduled_date' => $this->selectedDate,
                'start_time' => $this->intervals[$this->selectedIntervalId]['start_time'],
            ]
        );

        $this->dispatch('cartUpdated');

        $this->notify([
            'title' => 'Success',
            'type' => 'success',
            'message' => 'Celebrity added to cart',
        ]);
    }

    public function render()
    {
        return view('livewire.celebrity.show', [
            'availabilities' => $this->availabilities,
        ]);
    }
}
