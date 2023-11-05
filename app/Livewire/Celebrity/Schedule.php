<?php

declare(strict_types=1);

namespace App\Livewire\Celebrity;

use App\Livewire\AbstractCalendar;
use App\Services\Calendar;
use Carbon\Carbon;
use Illuminate\Support\Collection;


final class Schedule extends AbstractCalendar
{
    public function events(): Collection
    {
        return new Collection([
            Calendar::createEvent(
                id: 'unique-id',
                name: 'Sales Meeting',
                description: 'Review the sales for the month',
                href: 'https://openai.com/',
                startTime: Carbon::today()->addHours(8),
                endTime: Carbon::today()->addHours(16),
            ),
            Calendar::createEvent(
                id: 'another-unique-id',
                name: 'Marketing Meeting',
                description: 'Review the marketing for the month',
                href: 'https://openai.com/',
                startTime: Carbon::tomorrow()->addHours(8),
                endTime: Carbon::tomorrow()->addHours(16),
            ),
        ]);
    }
}
