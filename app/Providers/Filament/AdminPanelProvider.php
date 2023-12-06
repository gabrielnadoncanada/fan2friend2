<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login;
use App\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('dashboard')
            ->login(Login::class)
            ->passwordReset()
            ->registration()
            ->brandLogo(asset('svg/logo.svg'))
            ->brandLogoHeight('2.25rem')
            ->darkModeBrandLogo(asset('svg/logo-light.svg'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([

            ])
            ->colors([
                'primary' => [
                    //                    50 => '200, 221, 244',
                    //                    100 => '171, 203, 234',
                    //                    200 => '131, 178, 223',
                    //                    300 => '91, 153, 213',
                    400 => '254, 52, 72',
                    500 => '',
                    //                    600 => '32, 96, 137',
                    //                    700 => '50, 86, 99',
                    //                    800 => '9, 24, 39',
                    //                    900 => '000000',
                    //                    950 => '000000',
                ],
                //                'danger' => [
                //                    50 => '237, 161, 153',
                //                    100 => '226, 138, 138',
                //                    200 => '219, 104, 105',
                //                    300 => '209, 74, 73',
                //                    400 => '193, 48, 48',
                //                    500 => '162, 40, 40',
                //                    600 => '110, 37, 41',
                //                    700 => '72, 25, 27',
                //                    800 => '11, 6, 6',
                //                    900 => '000000',
                //                    950 => '000000',
                //                ],
                //                'gray' => [
                //                    50 => '249, 250, 251',
                //                    100 => '243, 244, 246',
                //                    200 => '229, 231, 235',
                //                    300 => '209, 213, 219',
                //                    400 => '156, 163, 175',
                //                    500 => '107, 114, 128',
                //                    600 => '75, 85, 99',
                //                    700 => '55, 65, 81',
                //                    800 => '31, 41, 55',
                //                    900 => '17, 24, 39',
                //                    950 => '13, 13, 13',
                //                ],
                //                //                'info' => [
                //                //                    50 => '238, 242, 255',
                //                //                    100 => '224, 231, 255',
                //                //                    200 => '199, 210, 254',
                //                //                    300 => '165, 180, 252',
                //                //                    400 => '129, 140, 248',
                //                //                    500 => '99, 102, 241',
                //                //                    600 => '79, 70, 229',
                //                //                    700 => '67, 56, 202',
                //                //                    800 => '55, 48, 163',
                //                //                    900 => '49, 46, 129',
                //                //                    950 => '30, 27, 75',
                //                //                ],
                //                'success' => [
                //                    50 => '217, 246, 166',
                //                    100 => '214, 237, 149',
                //                    200 => '202, 232, 113',
                //                    300 => '186, 225, 79',
                //                    400 => '173, 219, 44',
                //                    500 => '150, 192, 31',
                //                    600 => '114, 136, 33',
                //                    700 => '80, 95, 24',
                //                    800 => '24, 28, 11',
                //                    900 => '0, 0, 0',
                //                    950 => '0, 0, 0',
                //                ],
                //                'warning' => [
                //                    50 => '246, 231, 164',
                //                    100 => '237, 212, 147',
                //                    200 => '232, 197, 111',
                //                    300 => '225, 184, 77',
                //                    400 => '219, 170, 42',
                //                    500 => '191, 146, 30',
                //                    600 => '135, 101, 32',
                //                    700 => '94, 71, 23',
                //                    800 => '27, 22, 10',
                //                    900 => '0, 0, 0',
                //                    950 => '0, 0, 0',
                //                ],
            ])

            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([])
            ->databaseNotifications()
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->font('Larsseit')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
            ]);
    }
}
