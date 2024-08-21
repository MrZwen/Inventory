<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RealRashid\SweetAlert\SweetAlertServiceProvider;

class SweetAlertProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->register(SweetAlertServiceProvider::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
