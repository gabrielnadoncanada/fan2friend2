<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum WaitingRoomStatus: string implements HasLabel
{
    case WAITING = 'Waiting';

    case IN_SESSION = 'In_session';

    case COMPLETED = 'Completed';
    case CANCELLED = 'Cancelled';

    public function getLabel(): string
    {
        return match ($this) {
            self::WAITING => 'Waiting',
            self::IN_SESSION => 'In_session',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
