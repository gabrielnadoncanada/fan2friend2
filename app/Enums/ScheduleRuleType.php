<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ScheduleRuleType: string implements HasLabel
{
    case Day = 'Day';
    case Date = 'Date';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Day => 'Day',
            self::Date => 'Date',
        };
    }
}




