<?php

declare(strict_types=1);

namespace App\Traits;

use Carbon\Carbon;

trait ManagesConfiguration
{
    public int $weekStartsAt = Carbon::MONDAY;

    public int $weekEndsAt = Carbon::SUNDAY;

    public string $formatEventTime = 'g:i A';

    public string $formatTimeLabel = 'gA';
}
