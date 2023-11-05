<?php

declare(strict_types=1);

namespace App\Traits;
trait ManagesView
{
    public string $selectedView = 'month';

    public function selectView(string $view): void
    {
        $this->selectedView = $view;
    }
}
