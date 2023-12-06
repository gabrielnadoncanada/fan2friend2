<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Country: string implements HasLabel
{
    case CA = 'Canada';

    public function getLabel(): string
    {
        return __('countries.' . $this->name);
    }

    public static function values(): array
    {
        return array_combine(
            array_column(self::cases(), 'name'),
            array_map(fn ($case) => $case->getLabel(), self::cases())
        );
    }
}
