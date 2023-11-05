<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use App\Filament\Resources\CelebrityResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class CelebritiesRelationManager extends RelationManager
{
    protected static string $relationship = 'celebrities';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return CelebrityResource::form($form);
    }

    public function table(Table $table): Table
    {
        return CelebrityResource::table($table)
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->groupedBulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
