<?php

declare(strict_types=1);

namespace App\Traits;
use App\Contracts\MonthInterface;
use Illuminate\Support\Collection;

trait ManagesMonths
{
    public function getSelectedMonth(Collection $months): MonthInterface
    {
        return $months->get($this->selectedDateTime->month);
    }
}
