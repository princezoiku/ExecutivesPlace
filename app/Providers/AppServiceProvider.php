<?php

namespace App\Providers;

use App\Http\Services\CurrencyManager;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('currencyManager', function ($app) {
            return new CurrencyManager($app);
        });
    }
}
