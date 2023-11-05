<?php

namespace App\Livewire\Celebrity;

use App\Models\Celebrity;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Show extends Component
{
    public Celebrity $celebrity;
    public $currentDate;
    public $events = [];
    public $months = [];
    public $daysOfWeek = [];
    public int $daysInMonth;

    public function mount()
    {
        $this->currentDate = now();
//        $this->months = $this->getMonths();
        $this->daysOfWeek = $this->getDaysOfWeek();
        $this->daysInMonth = $this->currentDate->daysInMonth;
    }

//    public function loadEvents()
//    {
//        $eventsFromDb = Celebrity::whereYear('event_date', $this->currentDate->year)
//            ->whereMonth('event_date', $this->currentDate->month)
//            ->get();
//
//        $this->events = [];
//        foreach ($eventsFromDb as $event) {
//            $day = Carbon::parse($event->event_date)->day;
//            $this->events[$day][] = $event;
//        }
//    }
//
//    public function nextMonth()
//    {
//        $this->currentDate->addMonth();
//        $this->daysInMonth = $this->getDaysInMonth();
//    }
//
//    public function prevMonth()
//    {
//        $this->currentDate->subMonth();
//        $this->daysInMonth = $this->getDaysInMonth();
//    }
//
//    private function getMonths()
//    {
//        return array_map(function ($monthNumber) {
//            return __('app.date.months.' . $monthNumber);
//        }, range(1, 12));
//    }
//
    private function getDaysOfWeek()
    {
        return array_map(function ($dayNumber) {
            return __('app.date.daysOfWeek.' . $dayNumber);
        }, range(1, 7));
    }
//
//    private function getDaysInMonth()
//    {
//        return $this->currentDate->daysInMonth;
//    }

    public function render()
    {
        return view('livewire.celebrity.show');
    }
}


