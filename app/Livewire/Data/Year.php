<?php

declare(strict_types=1);

namespace App\Livewire\Data;

use App\Contracts\YearInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Macroable;

final class Year implements YearInterface
{
    use Macroable;

    /**
     * @param Collection<int, Month> $months
     */
    public function __construct(
        public Collection $months,
    ) {
        //
    }
}
