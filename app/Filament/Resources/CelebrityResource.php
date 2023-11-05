<?php

namespace App\Filament\Resources;

use App\Enums\ScheduleType;
use App\Enums\ScheduleWeekDay;
use App\Filament\Resources\CelebrityResource\Pages\CreateCelebrity;
use App\Filament\Resources\CelebrityResource\Pages\EditCelebrity;
use App\Filament\Resources\CelebrityResource\Pages\ListCelebrities;
use App\Filament\Resources\CelebrityResource\Pages\ViewCelebrity;
use App\Filament\Resources\CelebrityResource\RelationManagers\CommentsRelationManager;
use App\Filament\Resources\CelebrityResource\Widgets\CelebrityStats;
use App\Forms\Components\Schedule;
use App\Models\Celebrity;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CelebrityResource extends Resource
{
    protected static ?string $model = Celebrity::class;

    protected static ?string $slug = 'shop/celebrities';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?string $navigationLabel = 'Celebrities';

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        $defaultDays = [];
        foreach (ScheduleWeekDay::values() as $day) {
            $defaultDays[] = [
                'type' => ScheduleType::Day->value,
                'wday' => $day,
                'timeIntervals' => [
                    [
                        'from' => '10:00',
                        'to' => '12:00',
                    ],
                ],
            ];
        }

        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                        if ($operation !== 'create') {
                                            return;
                                        }

                                        $set('slug', Str::slug($state));
                                    }),

                                Forms\Components\TextInput::make('slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->unique(Celebrity::class, 'slug', ignoreRecord: true),

                                Forms\Components\MarkdownEditor::make('description')
                                    ->columnSpan('full'),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make('Images')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('media')
                                    ->collection('celebrity-images')
                                    ->multiple()
                                    ->maxFiles(5)
                                    ->disableLabel(),
                            ])
                            ->collapsible(),

                        Forms\Components\Section::make('Variations')
                            ->schema([
                                Forms\Components\Repeater::make('variations')
                                    ->label('variations')
                                    ->schema([
                                        Forms\Components\TextInput::make('duration')
                                            ->required(),
                                        Forms\Components\TextInput::make('price')
                                            ->required(),
                                    ])
                            ])
                            ->collapsible(),
                        Forms\Components\Section::make('Schedules')
                            ->schema([
                                Forms\Components\Repeater::make('schedules')
                                    ->label('schedules')
                                    ->schema([
                                        Forms\Components\Grid::make(2)->schema([
                                            Forms\Components\Select::make('type')
                                                ->options(ScheduleType::class)
                                                ->default(ScheduleType::Day->value)
                                                ->live()->required()
                                                ->afterStateUpdated(fn(Select $component) => $component
                                                    ->getContainer()
                                                    ->getComponent('dynamicTypeFields')
                                                    ->getChildComponentContainer()
                                                    ->fill())->columnSpan(1),
                                            Forms\Components\Group::make()
                                                ->schema(fn(Get $get): array => match ($get('type')) {
                                                    ScheduleType::Day->value => [
                                                        Forms\Components\Select::make('wday')
                                                            ->options(ScheduleWeekDay::class)
                                                            ->required(),
                                                    ],
                                                    ScheduleType::Date->value => [
                                                        Forms\Components\Datepicker::make('date')
                                                    ],
                                                    default => [],
                                                })
                                                ->key('dynamicTypeFields')->columnSpan(1),
                                        ]),
                                        Forms\Components\Repeater::make('timeIntervals')
                                            ->label('timeIntervals')
                                            ->schema([
                                                Forms\Components\TimePicker::make('from')
                                                    ->required()->default('10:00'),
                                                Forms\Components\TimePicker::make('to')
                                                    ->required()->default('12:00')
                                            ])->defaultItems(0)->columns(2)
                                    ])->columnSpanFull()
                                    ->default(
                                        fn() => $defaultDays
                                    )
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status')
                            ->schema([
                                Forms\Components\Toggle::make('is_visible')
                                    ->label('Visible')
                                    ->default(true),
                            ]),
                        Forms\Components\Section::make('Featured image')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('featured-media')
                                    ->collection('celebrity-featured-image')
                                    ->multiple()
                                    ->maxFiles(5)
                                    ->disableLabel(),
                            ]),
                        Forms\Components\Section::make('Associations')
                            ->schema([
                                Forms\Components\Select::make('categories')
                                    ->relationship('categories', 'name')
                                    ->multiple()
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
                Tables\Columns\SpatieMediaLibraryImageColumn::make('celebrity-featured-image')
                    ->label('Image')
                    ->collection('celebrity-featured-image'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_visible')
                    ->label('Visibility')
                    ->boolean()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Publish Date')
                    ->date()
                    ->sortable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_visible')
                    ->label('Visibility')
                    ->boolean()
                    ->trueLabel('Only visible')
                    ->falseLabel('Only hidden')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->groupedBulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->action(function () {
                        Notification::make()
                            ->title('Now, now, don\'t be cheeky, leave some records for others to play with!')
                            ->warning()
                            ->send();
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CommentsRelationManager::class,
        ];
    }

    public static function getWidgets(): array
    {
        return [
            CelebrityStats::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCelebrities::route('/'),
            'create' => CreateCelebrity::route('/create'),
            'edit' => EditCelebrity::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'sku'];
    }


}
