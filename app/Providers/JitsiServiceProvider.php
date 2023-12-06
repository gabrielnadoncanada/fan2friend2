<?php

namespace App\Providers;

use App\Services\JitsiService;
use Illuminate\Support\ServiceProvider;

class JitsiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(JitsiService::class, function ($app) {
            return new JitsiService();
        });
    }
}
