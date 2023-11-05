<?php

declare(strict_types=1);

namespace App\Contracts;

use Carbon\Carbon;

/**
 * @property Carbon $dateTime
 * @property string $dateTimeFormat
 */
interface TimeLabelInterface
{
    public function toString(): string;
}
