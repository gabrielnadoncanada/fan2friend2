<?php

namespace App\Providers;

use App\Livewire\Data\Day;
use App\Livewire\Data\DayLabel;
use App\Livewire\Data\Event;
use App\Livewire\Data\Month;
use App\Livewire\Data\TimeLabel;
use App\Livewire\Data\Week;
use App\Livewire\Data\Year;
use App\Services\Calendar;
use Filament\Support\Facades\FilamentView;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (request()->path() === 'admin/login'):
            FilamentView::registerRenderHook(
                'panels::body.start',
                fn() => view('filament.app.sections.header')
            );
            FilamentView::registerRenderHook(
                'panels::body.end',
                fn() => view('filament.app.sections.footer')
            );
        endif;

        if (request()->path() === 'admin/profile'):
            FilamentView::registerRenderHook(
                'panels::content.start',
                fn() => view('filament.app.sections.profile')
            );
        endif;

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::unguard();
        Schema::defaultStringLength(191);

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        Calendar::createEventUsing(Event::class);

        Calendar::createDayUsing(Day::class);
        Calendar::createMonthUsing(Month::class);
        Calendar::createWeekUsing(Week::class);
        Calendar::createYearUsing(Year::class);

        Calendar::createDayLabelUsing(DayLabel::class);
        Calendar::createTimeLabelUsing(TimeLabel::class);
    }
}
