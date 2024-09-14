<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\School;
use App\Observers\SchoolObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        School::observe(SchoolObserver::class);
    }
}
