<?php

namespace App\Filament\Resources\CelebrityResource\Pages;

use App\Filament\Resources\CelebrityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Livewire\Attributes\On;

class EditCelebrity extends EditRecord
{
    protected static string $resource = CelebrityResource::class;

    #[On('refreshSchedules')]
    public function refreshSchedules($recordId = null)
    {
        if ($this->data['default_schedule_id'] === $recordId) {
            $this->refreshFormData(['default_schedule_id']);
        } else {
            $this->refresh();
        }
    }

    public function refresh(): void
    {
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
