<?php

declare(strict_types=1);

namespace App\Traits;
use App\Contracts\DayInterface;
use App\Contracts\WeekInterface;
use Illuminate\Support\Collection;

trait ManagesWeeks
{
    public function getSelectedWeek(Collection $months): WeekInterface
    {
        return $this
            ->getSelectedMonth($months)
            ->weeks
            ->flatten()
            ->filter(fn (WeekInterface $week) => $week->days->filter(fn (DayInterface $day): bool => $day->date->weekOfYear === $this->selectedDateTime->weekOfYear)->count() > 0)
            ->first();
    }
}
