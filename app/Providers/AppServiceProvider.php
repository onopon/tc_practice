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
        if ($this->app->environment('testing')) {
            // テスト環境では別途モックを登録するため、スキップ
            return;
        }
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
