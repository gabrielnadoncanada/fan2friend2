<?php

namespace App\Filament\Resources;

use App\Enums\CanadianProvince;
use App\Enums\OrderStatus;
use App\Filament\Resources\OrderResource\Pages\CreateOrder;
use App\Filament\Resources\OrderResource\Pages\EditOrder;
use App\Filament\Resources\OrderResource\Pages\ListOrders;
use App\Filament\Resources\OrderResource\Pages\ViewOrder;
use App\Filament\Resources\OrderResource\RelationManagers\OrderItemsRelationManager;
use App\Filament\Resources\OrderResource\RelationManagers\PaymentsRelationManager;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $recordTitleAttribute = 'number';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?int $navigationSort = 2;

    protected static ?string $label = 'commande';

    protected static ?string $title = 'commande';

    protected static ?string $pluralLabel = 'commandes';

    protected static ?string $pluralModelLabel = 'commandes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(static::getFormSchema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->label('Numéro'),
                Tables\Columns\TextColumn::make('user.fullName')
                    ->label('Client'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge(),
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->date(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

                Tables\Actions\DeleteAction::make(),
            ])
            ->groupedBulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            OrderItemsRelationManager::class,
            PaymentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrders::route('/'),
            'view' => ViewOrder::route('/{record}/view'),
            'create' => CreateOrder::route('/create'),
            'edit' => EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getFormSchema(string $section = null): array
    {
        return [
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\Grid::make()
                        ->schema([
                            Forms\Components\TextInput::make('number')
                                ->label('Numéro')
                                ->default('OR-' . random_int(100000, 999999))
                                ->disabled()
                                ->dehydrated()
                                ->required(),
                            Forms\Components\Select::make('user_id')
                                ->relationship('user', 'full_name')
                                ->label('Client')
                                ->required(),
                        ]),
                    Forms\Components\Select::make('status')
                        ->label('Statut')
                        ->options(OrderStatus::class)
                        ->required()
                        ->native(false),
                    Forms\Components\MarkdownEditor::make('notes')
                        ->columnSpan('full'),
                    Forms\Components\Fieldset::make('Adresse')
                        ->schema([
                            Forms\Components\Grid::make()
                                ->schema([
                                    Forms\Components\TextInput::make('street')
                                        ->required()
                                        ->label('Rue'),
                                    Forms\Components\TextInput::make('postal_code')
                                        ->required()
                                        ->label('Code postal'),
                                    Forms\Components\TextInput::make('city')
                                        ->required()
                                        ->label('Ville'),
                                    Forms\Components\Select::make('state')
                                        ->label('Province')
                                        ->required()
                                        ->options(CanadianProvince::class),
                                    Forms\Components\Select::make('country')
                                        ->label('Pays')
                                        ->searchable()
                                        ->required()
                                        ->default('CA')
                                        ->options([
                                            'CA' => 'Canada',
                                        ]),
                                ])->columns(2),
                        ]),
                ]),

        ];
    }
}
