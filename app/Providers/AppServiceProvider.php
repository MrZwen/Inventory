<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\ItemsRepository;
use App\Services\ItemService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind(ItemsRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
