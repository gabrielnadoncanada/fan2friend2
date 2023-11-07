<?php

namespace App\Providers;


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
    }
}
