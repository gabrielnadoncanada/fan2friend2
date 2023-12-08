<?php

namespace App\Filament\Resources;

use App\Enums\CanadianProvince;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\PaymentsRelationManager;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static bool $shouldRegisterNavigation = true;

    protected static ?string $label = 'utilisateur';

    protected static ?string $pluralLabel = 'utilisateurs';

    protected static ?string $pluralModelLabel = 'utilisateurs';

    protected static ?string $title = 'utilisateur';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema(static::getFormSchema())
                    ->columnSpan(2),
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Créé le')
                            ->content(fn (User $record): ?string => $record->created_at?->diffForHumans())
                            ->hidden(fn (?User $record) => $record === null),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Dernière modification le')
                            ->content(fn (User $record): ?string => $record->updated_at?->diffForHumans())
                            ->hidden(fn (?User $record) => $record === null),
                        Forms\Components\Select::make('roles')
                            ->label('Rôles')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->required(),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Prénom'),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Nom'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Courriel'),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Rôles')
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PaymentsRelationManager::class,
        ];
    }

    public static function getFormSchema(): array
    {
        return [
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\Grid::make()
                        ->schema(
                            [
                                Forms\Components\TextInput::make('first_name')
                                    ->label('Prénom')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('last_name')
                                    ->label('Nom')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('email')
                                    ->label('Courriel')
                                    ->email()
                                    ->unique(ignoreRecord: true)
                                    ->required()
                                    ->dehydrated(fn (string $operation): bool => $operation !== 'create')
                                    ->maxLength(255)
                                    ->disabled(fn (string $operation): bool => $operation !== 'create'),
                                Forms\Components\TextInput::make('phone')
                                    ->label('Téléphone')
                                    ->maxValue(50),
                            ]
                        )->columns(2),
                ]),

            Forms\Components\Section::make('Adresse')
                ->collapsible()
                ->collapsed()
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
            Forms\Components\Section::make('Mot de passe')
                ->hidden(fn (?User $record) => $record === null)
                ->collapsible()
                ->collapsed()
                ->schema([
                    Forms\Components\Grid::make()
                        ->schema([
                            Forms\Components\TextInput::make('password')
                                ->label('Nouveau mot de passe')
                                ->password()
                                ->required(fn (?User $record) => $record === null)
                                ->rule(Password::default())
                                ->autocomplete('new-password')
                                ->dehydrated(fn ($state): bool => filled($state))
                                ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
                                ->live(debounce: 500)
                                ->hidden(fn (?User $record) => $record === null)
                                ->same('passwordConfirmation'),
                            Forms\Components\TextInput::make('passwordConfirmation')
                                ->label('Confirmation du mot de passe')
                                ->password()
                                ->required()
                                ->hidden(fn (?User $record) => $record === null)
                                ->visible(fn (Get $get): bool => filled($get('password')))
                                ->dehydrated(false),
                        ])->columns(2),
                ]),

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
