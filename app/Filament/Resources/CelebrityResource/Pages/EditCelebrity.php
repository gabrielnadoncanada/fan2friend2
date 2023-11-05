<?php

namespace App\Filament\Resources\CelebrityResource\Pages;

use App\Filament\Resources\CelebrityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCelebrity extends EditRecord
{
    protected static string $resource = CelebrityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make()
        ];
    }
}
