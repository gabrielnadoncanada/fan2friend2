<?php

namespace App\Filament\Resources\CelebrityResource\RelationManagers;

use App\Filament\Resources\OrderItemResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'orderItems';

    protected static ?string $recordTitleAttribute = 'title';

    public function form(Form $form): Form
    {
        return OrderItemResource::form($form);
    }

    public function table(Table $table): Table
    {
        return OrderItemResource::table($table);
    }
}
