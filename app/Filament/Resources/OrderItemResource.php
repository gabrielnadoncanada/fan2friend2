<?php

namespace App\Filament\Resources;

use App\Models\OrderItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class OrderItemResource extends Resource
{
    protected static ?string $model = OrderItem::class;

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
                Tables\Columns\TextColumn::make('scheduled_date')
                    ->label('Date de réservation')
                    ->date('d/m/Y'),
                Tables\Columns\TextColumn::make('start_time')
                    ->label('Heure de réservation')
                    ->date('H:i'),
                Tables\Columns\TextColumn::make('client')
                    ->getStateUsing(function (Model $record) {
                        return $record->order->user->fullName;
                    }),
                Tables\Columns\TextColumn::make('unit_price')
                    ->label('Prix unitaire')
                    ->getStateUsing(function (Model $record) {
                        return $record->unit_price . '$';
                    }),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Quantité'),
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Prix total')
                    ->getStateUsing(function (Model $record) {
                        return $record->total_price . '$';
                    }),
                Tables\Columns\TextColumn::make('duration')
                    ->label('Durée')
                    ->getStateUsing(function (Model $record) {
                        return $record->duration . 'min';
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('openWaitingRoom')
                    ->tooltip('Open waiting room')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->url(function ($record): ?string {
                        return route('celebrity.waiting-room', ['category' => $record->celebrity->category->slug, 'celebrity' => $record->celebrity]);
                    }, shouldOpenInNewTab: true),
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
                    Forms\Components\DatePicker::make('scheduled_date')
                        ->label('Date de réservation')
                        ->date('d/m/Y'),
                    Forms\Components\TimePicker::make('start_time')
                        ->label('Heure de réservation')
                        ->date('H:i'),
                    Forms\Components\Select::make('celebrity_id')
                        ->relationship('celebrity', 'full_name')
                        ->label('Celébrité')
                        ->required(),
                ])->columns(3),
            Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\TextInput::make('unit_price')
                        ->label('Prix unitaire')
                        ->required(),
                    Forms\Components\TextInput::make('quantity')
                        ->label('Quantité')
                        ->required(),
                    Forms\Components\TextInput::make('total_price')
                        ->label('Prix total')
                        ->required(),
                    Forms\Components\TextInput::make('duration')
                        ->numeric()
                        ->label('Durée'),
                ]),
        ];
    }
}
