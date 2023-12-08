<?php

namespace App\Providers;

use Filament\Actions\DeleteAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TimePicker;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot()
    {

        //        Table::configureUsing(
        //            fn(Table $table) => $table
        //                ->filtersTriggerAction(
        //                    fn(Action $action) => $action
        //                        ->button()
        //                        ->label('Filtres'),
        //                )->filtersFormWidth('2xl')
        //        );
        //
        //        Column::configureUsing(function (Column $column): void {
        //            $column
        //                ->toggleable()
        //                ->sortable();
        //        });
        //
        //        TextColumn::configureUsing(function (TextColumn $column): void {
        //            $column->searchable(isIndividual: true);
        //        });
        //
        //        ImageColumn::configureUsing(function (ImageColumn $column): void {
        //            $column->default(asset('/placeholder.png'));
        //            $column->disk(config('filesystems.default'))->visibility('private');
        //        });
        //
        (new \BezhanSalleh\FilamentShield\FilamentShield)->configurePermissionIdentifierUsing(
            function ($resource) {
                $resource = Str::of($resource)
                    ->afterLast('Resources\\')
                    ->before('Resource')
                    ->replace('\\', '::');
                if ($resource->contains('::')) {

                    return str($resource)->beforeLast('::') . '::' . str($resource)->afterLast('::')->lcfirst();
                }

                return str($resource)->lcfirst();
            }
        );

        //        Filament::registerRenderHook(
        //            'panels::body.start',
        //            fn(): View => view('components.staging-banner'),
        //        );

        //        FileUpload::configureUsing(fn(FileUpload $fileUpload) => $fileUpload->disk(config('filesystems.default'))->visibility('private'));

        //        DeleteAction::configureUsing(function ($action) {
        //            $action->using(static function (Model $record) {
        //                try {
        //                    return $record->delete();
        //                } catch (\Exception $e) {
        //                    if ($e->getCode() === '23000') {
        //                        Notification::make()
        //                            ->title('Cet enregistrement est en cours d\'utilisation et ne peut pas être supprimé.')
        //                            ->danger()
        //                            ->send();
        //                    }
        //                    return false;
        //                }
        //            });
        //        });
        //        DateTimePicker::configureUsing(fn (DateTimePicker $field) => $field->timezone(config('app.local_timezone')));
        //        DatePicker::configureUsing(fn (DatePicker $field) => $field->timezone(config('app.local_timezone')));
        //        TimePicker::configureUsing(fn (TimePicker $field) => $field->timezone(config('app.local_timezone')));

        //        make a function witch allow to divide the day in 30 minutes interval

        TimePicker::configureUsing(function (TimePicker $field) {
            $field->datalist($this->getIntervals(15));
        });
    }
}
