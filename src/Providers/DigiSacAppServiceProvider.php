<?php

declare(strict_types=1);

namespace DigiSac\Base\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use DigiSac\Base\Services\CompanyContext;
use DigiSac\Base\Services\Contracts\Context;
use Session;

class DigiSacAppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Context::class, CompanyContext::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__.'/public'=>public_path('vendor/digisac/core-integration-laravel')]);


        $this->loadViewsFrom(__DIR__ . '/../../resources/views','core-integration-laravel');


    }
}
