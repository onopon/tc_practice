<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Libraries\Api\Forecast;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Forecast::class, Forecast::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
