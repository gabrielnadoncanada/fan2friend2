<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum OrderStatus: string implements HasColor, HasLabel
{
    case PENDING = 'Pending';
    case PAID = 'Paid';
    case DELIVERED = 'Delivered';
    case CANCELED = 'Canceled';

    public function getLabel(): string
    {
        return $this->value;
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::PAID => 'info',
            self::DELIVERED => 'success',
            self::CANCELED => 'danger',
        };
    }
}
