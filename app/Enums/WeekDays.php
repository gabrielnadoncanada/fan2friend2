<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum WeekDays: string implements HasLabel
{
    case SUNDAY = 'Sunday';
    case MONDAY = 'Monday';
    case TUESDAY = 'Tuesday';
    case WEDNESDAY = 'Wednesday';
    case THURSDAY = 'Thursday';
    case FRIDAY = 'Friday';
    case SATURDAY = 'Saturday';

    public function getLabel(): string
    {
        return $this->value;
    }

    public function getShortLabel(): string
    {
        return match ($this) {
            self::SUNDAY => 'Su',
            self::MONDAY => 'Mo',
            self::TUESDAY => 'Tu',
            self::WEDNESDAY => 'We',
            self::THURSDAY => 'Th',
            self::FRIDAY => 'Fr',
            self::SATURDAY => 'Sa',
        };
    }

    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }
}
