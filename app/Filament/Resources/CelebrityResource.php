<?php

namespace App\Filament\Resources;

use App\Enums\WeekDays;
use App\Filament\Resources\CelebrityResource\Pages\CreateCelebrity;
use App\Filament\Resources\CelebrityResource\Pages\EditCelebrity;
use App\Filament\Resources\CelebrityResource\Pages\ListCelebrities;
use App\Filament\Resources\CelebrityResource\RelationManagers\OrderItemsRelationManager;
use App\Models\Celebrity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CelebrityResource extends Resource
{
    protected static ?string $model = Celebrity::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?string $label = 'célébrité';

    protected static ?string $title = 'célébrité';

    protected static ?string $pluralLabel = 'célébrités';

    protected static ?string $pluralModelLabel = 'célébrités';

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema(static::getFormSchema())
                    ->columnSpan(['lg' => 2]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Image à la une')
                            ->schema([
                                Forms\Components\SpatieMediaLibraryFileUpload::make('featured_image')
                                    ->collection('celebrity-featured-image')
                                    ->label('Image')
                                    ->image()
                                    ->required(),
                            ]),
                        Forms\Components\Section::make('Associations')
                            ->schema([
                                Forms\Components\Select::make('categories')
                                    ->relationship('categories', 'title')
                                    ->multiple()
                                    ->preload()
                                    ->required(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('featured_image')
                    ->collection('celebrity-featured-image')
                    ->label('Image à la une'),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nom complet'),
                Tables\Columns\TextColumn::make('categories.title')
                    ->label('Catégories')
                    ->badge(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->groupedBulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getFormSchema(): array
    {
        return [
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('first_name')
                        ->label('Prénom')
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set, Forms\Get $get) => static::updateSlug($operation, $set, $get))
                        ->required(),
                    Forms\Components\TextInput::make('last_name')
                        ->label('Nom')
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set, Forms\Get $get) => static::updateSlug($operation, $set, $get))
                        ->required(),
                    Forms\Components\TextInput::make('slug')
                        ->disabled()
                        ->dehydrated()
                        ->required()
                        ->unique(Celebrity::class, 'slug', ignoreRecord: true),
                    Forms\Components\Select::make('user_id')
                        ->label('Utilisateur')
                        ->required()
                        ->relationship('user', 'full_name'),
                    Forms\Components\Select::make('partner_id')
                        ->label('Partenaire')
                        ->live()
                        ->relationship('partner', 'title'),
                    Forms\Components\MarkdownEditor::make('description')
                        ->label('Description')
                        ->columnSpan('full'),
                ])
                ->columns(),
            Forms\Components\Section::make('Images')
                ->label('Images')
                ->schema([
                    Forms\Components\SpatieMediaLibraryFileUpload::make('images')
                        ->multiple()
                        ->image()
                        ->collection('celebrity-images')
                        ->maxFiles(5),
                ])
                ->collapsed()
                ->collapsible(),
            Forms\Components\Section::make('Plage de dates')
                ->schema([
                    Forms\Components\Datepicker::make('start_date')
                        ->live()
                        ->minDate(now()->format('Y-m-d'))
                        ->required(),
                    Forms\Components\Datepicker::make('end_date')
                        ->required(),
                ])
                ->collapsible()
                ->collapsed()
                ->columns(2),
            Forms\Components\Section::make('Limites des événements')
                ->collapsible()
                ->collapsed()
                ->schema([
                    Forms\Components\Fieldset::make('Temps tampon')
                        ->schema([
                            Forms\Components\TextInput::make('before_buffer_time')
                                ->numeric()
                                ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                ->required(),
                            Forms\Components\TextInput::make('after_buffer_time')
                                ->numeric()
                                ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                ->required(),
                        ]),
                ])
                ->columns(2),
            Forms\Components\Section::make('Options additionelles')
                ->collapsible()
                ->collapsed()
                ->schema([
                    Forms\Components\Fieldset::make('Incréments d\'heure de début')
                        ->schema([
                            Forms\Components\TextInput::make('spot_step')
                                ->numeric()
                                ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                ->required(),
                        ]),
                ]),
            Forms\Components\Section::make('Disponibilité')
                ->collapsible()
                ->collapsed()
                ->schema(
                    [
                        Forms\Components\Section::make('Horaires hebdomadaires')
                            ->collapsible()
                            ->collapsed()
                            ->schema(static::getScheduleRuleFormFieldsSchema()),
                        Forms\Components\Section::make('Horaires spécifiques à une date')
                            ->collapsible()
                            ->collapsed()
                            ->schema(static::getScheduleRuleExceptionFormFieldsSchema()),
                    ]
                ),
        ];
    }

    public static function getRelations(): array
    {

        return [
            OrderItemsRelationManager::class,
        ];
    }

    protected static function updateSlug(string $operation, Forms\Set $set, Forms\Get $get)
    {
        if ($operation === 'create') {
            $firstName = $get('first_name');
            $lastName = $get('last_name');

            if ($firstName && $lastName) {
                $slug = Str::slug($firstName . ' ' . $lastName);
                $set('slug', $slug);
            }
        }
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCelebrities::route('/'),
            'create' => CreateCelebrity::route('/create'),
            'edit' => EditCelebrity::route('/{record}/edit'),
        ];
    }

    public static function getScheduleRuleFormFieldsSchema(): array
    {
        return [
            Forms\Components\Repeater::make('scheduleRules')
                ->label('')
                ->deletable(false)
                ->addable(false)
                ->collapsible()
                ->relationship()
                ->schema([
                    Forms\Components\Grid::make()
                        ->schema([
                            Forms\Components\Select::make('wday')
                                ->label('Jour de la semaine')
                                ->options(WeekDays::class)
                                ->disabled()
                                ->dehydrated()
                                ->columnSpan(4),
                            Forms\Components\Repeater::make('intervals')
                                ->label('Intervalles')
                                ->relationship()
                                ->schema([
                                    Forms\Components\Grid::make()
                                        ->schema([
                                            Forms\Components\Select::make('start_time')
                                                ->label('De')
                                                ->options(static::getIntervals(15))
                                                ->columnSpan(1),
                                            Forms\Components\Select::make('end_time')
                                                ->options(static::getIntervals(15))
                                                ->label('À')
                                                ->columnSpan(1),
                                        ])
                                        ->columns(2),
                                ])
                                ->defaultItems(0)
                                ->columnSpan(8),
                        ])
                        ->columns(12),
                ])->default(
                    function () {
                        foreach (WeekDays::values() as $day) {
                            $rules[] = [
                                'type' => 'wday',
                                'wday' => $day,
                            ];
                        }

                        return $rules;
                    }
                ),

        ];
    }

    public static function getScheduleRuleExceptionFormFieldsSchema(): array
    {
        return [
            Forms\Components\Repeater::make('scheduleRuleExceptions')
                ->label('')
                ->addActionLabel('Ajouter une date')
                ->collapsible()
                ->relationship()
                ->defaultItems(0)
                ->schema([
                    Forms\Components\Grid::make()
                        ->schema([
                            Forms\Components\DatePicker::make('date')
                                ->label('Date')
                                ->required()
                                ->columnSpan(4),
                            Forms\Components\Fieldset::make('Plage horaire')
                                ->schema([
                                    Forms\Components\Repeater::make('intervals')
                                        ->label('Intervalles')
                                        ->relationship()
                                        ->addActionLabel('Ajouter une plage horaire')
                                        ->schema([
                                            Forms\Components\Grid::make()
                                                ->schema([
                                                    Forms\Components\Select::make('start_time')
                                                        ->options(static::getIntervals(15))
                                                        ->label('De'),

                                                    Forms\Components\Select::make('end_time')
                                                        ->options(static::getIntervals(15))
                                                        ->label('À'),
                                                ]),
                                        ])
                                        ->columnSpan(12)
                                        ->defaultItems(0),
                                ])
                                ->columnSpan(8),
                        ])
                        ->columns(12),
                ]),
        ];
    }

    public static function getIntervals($interval)
    {
        $intervals = [];

        for ($hour = 0; $hour < 24; $hour++) {
            for ($minute = 0; $minute < 60; $minute += $interval) {
                $time = sprintf('%02d:%02d', $hour, $minute);
                $intervals[$time] = $time;
            }
        }

        return $intervals;
    }
}
