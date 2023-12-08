<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use App\Services\BookingService;
use Filament\Support\Facades\FilamentView;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Livewire\Component;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('bookingService', function ($app) {
            return new BookingService();
        });
        FilamentView::registerRenderHook(
            'panels::auth.login.form.before',
            fn () => view('components.fill-user-by-role')
        );
        //        $includedRoutes = [
        //            'admin/login',
        //            'admin/register',
        //            'admin/password/reset',
        //            'admin/password/email',
        //            'admin/password/reset/{token}',
        //        ];
        //
        //        if (in_array(request()->path(), $includedRoutes)) {
        //            FilamentView::registerRenderHook(
        //                'panels::body.start',
        //                fn() => view('livewire.header')
        //            );
        //            FilamentView::registerRenderHook(
        //                'panels::body.end',
        //                fn() => view('sections.footer')
        //            );
        //        }
    }

    public function boot()
    {
        Model::unguard();
        Schema::defaultStringLength(191);
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
        User::observe(UserObserver::class);

        Component::macro('notify', function ($event) {
            $this->dispatch('notify', [
                'title' => $event['title'],
                'description' => $event['message'],
                'type' => $event['type'] ?? 'success',
            ]);
        });

    }
}
