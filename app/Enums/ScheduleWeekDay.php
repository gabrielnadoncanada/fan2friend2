<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ScheduleWeekDay: int implements HasLabel
{
    case Sunday = 1;
    case Monday = 2;
    case Tuesday = 3;
    case Wednesday = 4;
    case Thursday = 5;
    case Friday = 6;
    case Saturday = 7;

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




