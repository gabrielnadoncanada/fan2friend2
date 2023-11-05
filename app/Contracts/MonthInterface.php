<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Support\Collection;

/**
 * @property int                            $number
 * @property Collection<int, WeekInterface> $weeks
 */
interface MonthInterface
{
    public function getName(): string;
}
