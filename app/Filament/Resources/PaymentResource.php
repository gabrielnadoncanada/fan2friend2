<?php

namespace App\Filament\Resources;

use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(static::getFormFieldsSchema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order.number')
                    ->label('Commande')
                    ->url(fn ($record) => OrderResource::getUrl('edit', [$record->order]))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('reference')
                    ->label('Référence')
                    ->searchable(),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Montant')
                    ->sortable()
                    ->money(fn ($record) => $record->currency),

                Tables\Columns\TextColumn::make('provider')
                    ->label('Fournisseur')
                    ->formatStateUsing(fn ($state) => Str::headline($state))
                    ->sortable(),

                Tables\Columns\TextColumn::make('method')
                    ->label('Méthode')
                    ->formatStateUsing(fn ($state) => Str::headline($state))
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getFormFieldsSchema(): array
    {
        return [
            Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\Select::make('order_id')
                        ->label('Commande')
                        ->relationship(
                            'order',
                            'number',
                            fn (Builder $query, RelationManager $livewire) => $query->whereBelongsTo($livewire->ownerRecord)
                        )
                        ->searchable()
                        ->hiddenOn('edit')
                        ->required(),

                    Forms\Components\TextInput::make('reference')
                        ->label('Référence')
                        ->columnSpan(fn (string $operation) => $operation === 'edit' ? 2 : 1)
                        ->required(),

                    Forms\Components\TextInput::make('amount')
                        ->label('Montant')
                        ->numeric()
                        ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                        ->required(),

                    Forms\Components\Select::make('currency')
                        ->label('Devise')
                        ->options(collect(Currency::getCurrencies())->mapWithKeys(fn ($item, $key) => [$key => data_get($item, 'name')]))
                        ->searchable()
                        ->required(),

                    Forms\Components\Select::make('provider')
                        ->label('Fournisseur')
                        ->options([
                            'stripe' => 'Stripe',
                            'paypal' => 'PayPal',
                        ])
                        ->required()
                        ->native(false),

                    Forms\Components\Select::make('method')
                        ->label('Méthode')
                        ->options([
                            'credit_card' => 'Credit card',
                            'bank_transfer' => 'Bank transfer',
                            'paypal' => 'PayPal',
                        ])
                        ->required()
                        ->native(false),
                ]),

        ];
    }
}
