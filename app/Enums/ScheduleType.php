<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ScheduleType: string implements HasLabel
{
    case Day = 'Day';
    case Date = 'date';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Day => 'Day',
            self::Date => 'Date',
        };
    }
}




