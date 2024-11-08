<?php

namespace App\Providers;

use App\View\Components\Errors\Layout as ErrorLayout;
use App\View\Components\Success\Layout as SuccessLayout;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        if ($this->app->environment('local')) {
            Mail::alwaysTo('fadilmartias26@gmail.com', 'Fadil Martias');
        }
        Blade::component('errors-layout', ErrorLayout::class);
        Blade::component('success-layout', SuccessLayout::class);
    }
}
