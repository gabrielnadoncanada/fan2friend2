<?php

declare(strict_types=1);

namespace App\Livewire\Data;

use App\Contracts\MonthInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Macroable;

final class Month implements MonthInterface
{
    use Macroable;

    /**
     * @param Collection<int, Week> $weeks
     */
    public function __construct(
        public int $number,
        public Collection $weeks,
    ) {
        //
    }

    public function getName(): string
    {
        return \date('F', \mktime(0, null, null, $this->number, 1));
    }
}
