<?php

namespace App\Filament\Resources\CelebrityResource\Pages;

use App\Filament\Resources\CelebrityResource;
use Filament\Pages\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListCelebrities extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = CelebrityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return CelebrityResource::getWidgets();
    }
}
