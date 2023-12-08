<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

/**
 * Class WeekDays
 * Represents an enumeration of the days of the week.
 */
enum WeekDays: string implements HasLabel
{
    case SUNDAY = 'Sunday';
    case MONDAY = 'Monday';
    case TUESDAY = 'Tuesday';
    case WEDNESDAY = 'Wednesday';
    case THURSDAY = 'Thursday';
    case FRIDAY = 'Friday';
    case SATURDAY = 'Saturday';

    /**
     * Retrieves the label value.
     *
     * @return string The label value associated with this object.
     */
    public function getLabel(): string
    {
        return $this->value;
    }

    /**
     * Retrieves the short label value.
     *
     * @return string The short label value associated with this object.
     */
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

    /**
     * Retrieves an array of values from the cases array.
     *
     * @return array An array of values associated with the cases objects.
     */
    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }
}
