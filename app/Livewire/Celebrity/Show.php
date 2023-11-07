<?php

namespace App\Livewire\Celebrity;

use App\Models\Celebrity;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Show extends Component
{
    public Celebrity $celebrity;
    public Carbon $currentDate;
    public int $startOfWeek;
    public int $daysInMonth;
    public array $scheduleRules;
    public int $currentSelectedScheduleRuleIndex = 0;
    public int $currentSelectedVariationIndex = 0;

    public function mount(): void
    {
        $this->currentDate = now();
        $this->updateMonthData();
        $this->fetchMonthScheduleRules();
    }

    private function updateMonthData(): void
    {
        $this->startOfWeek = $this->currentDate->copy()->firstOfMonth()->dayOfWeek;
        $this->daysInMonth = $this->currentDate->daysInMonth;
    }

    public function moveMonth(int $direction): void
    {
        $this->currentDate->firstOfMonth();
        $this->currentDate = ($direction === 1) ? $this->currentDate->addMonth() : $this->currentDate->subMonth();
        $this->updateMonthData();
        $this->fetchMonthScheduleRules();
    }

    public function nextMonth(): void
    {
        $this->moveMonth(1);
    }

    public function prevMonth(): void
    {
        $this->moveMonth(-1);
    }

    public function setCurrentDay($day): void
    {
        $this->currentDate->day = $day;
    }

    private function loadScheduleRules($scheduleRules)
    {

    }

    public function fetchMonthScheduleRules()
    {

        $weeklySchedule = $this->celebrity->scheduleRules;
        $monthSchedule = [];
        $monthScheduleOveridedDates = [];

        foreach ($weeklySchedule as $schedule) {
            if ($schedule['type'] === 'Date' && isset($schedule['date'])) {
                $monthScheduleOveridedDates[] = $schedule;
            } else {
                $monthSchedule[$schedule['wday']] = $schedule['timeIntervals'];
            }
        }

        $monthScheduleParsed = [];

        for ($day = 1; $day <= $this->daysInMonth; $day++) {
            $weekday = ($day + $this->startOfWeek - 2) % 7 + 1;
            $scheduleForDay = $monthSchedule[$weekday];
            $monthScheduleParsed[$day] = $scheduleForDay;
        }

        foreach ($monthScheduleOveridedDates as $overriddenSchedule) {
            $date = Carbon::parse($overriddenSchedule['date']);

            if ($date->month == $this->currentDate->month && $date->year == $this->currentDate->year) {
                $monthScheduleParsed[$date->day] = $overriddenSchedule['timeIntervals'];

            }
        }
        $this->scheduleRules = $monthScheduleParsed;
    }

    public function addToCart(){
        $this->validate([
            'currentSelectedScheduleRuleIndex' => 'required',
            'currentSelectedVariationIndex' => 'required',
        ]);


    }

    public function render()
    {
        return view('livewire.celebrity.show');
    }
}

