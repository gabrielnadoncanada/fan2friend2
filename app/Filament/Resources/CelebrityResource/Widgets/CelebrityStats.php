<?php

namespace App\Filament\Resources\CelebrityResource\Widgets;

use App\Filament\Resources\CelebrityResource\Pages\ListCelebrities;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class CelebrityStats extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;

    protected function getTablePage(): string
    {
        return ListCelebrities::class;
    }

    protected function getStats(): array
    {
        return [
//            Stat::make('Total Celebrities', $this->getPageTableQuery()->count()),
//            Stat::make('Celebrity Inventory', $this->getPageTableQuery()->sum('qty')),
//            Stat::make('Average price', number_format($this->getPageTableQuery()->avg('price'), 2)),
        ];
    }
}
