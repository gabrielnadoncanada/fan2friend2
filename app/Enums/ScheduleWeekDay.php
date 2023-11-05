<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ScheduleWeekDay: string implements HasLabel
{
    case Sunday = 'Sunday';
    case Monday = 'Monday';
    case Tuesday = 'Tuesday';
    case Wednesday = 'Wednesday';
    case Thursday = 'Thursday';
    case Friday = 'Friday';
    case Saturday = 'Saturday';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Sunday => 'Sunday',
            self::Monday => 'Monday',
            self::Tuesday => 'Tuesday',
            self::Wednesday => 'Wednesday',
            self::Thursday => 'Thursday',
            self::Friday => 'Friday',
            self::Saturday => 'Saturday',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}




