<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum CanadianProvince: string implements HasLabel
{
    case AB = 'Alberta';
    case BC = 'British Columbia';
    case MB = 'Manitoba';
    case NB = 'New Brunswick';
    case NL = 'Newfoundland and Labrador';
    case NS = 'Nova Scotia';
    case NT = 'Northwest Territories';
    case NU = 'Nunavut';
    case ON = 'Ontario';
    case PE = 'Prince Edward Island';
    case QC = 'Quebec';
    case SK = 'Saskatchewan';
    case YT = 'Yukon';

    public function getLabel(): string
    {
        return __('provinces.' . $this->name);
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
