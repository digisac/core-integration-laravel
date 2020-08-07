<?php

namespace DigiSac\Base\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            \App\Repositories\AccessAuthorizationRepository::class,
            \App\Repositories\AccessAuthorizationRepositoryEloquent::class
        );

        $this->app->bind(
            \App\Repositories\BilletRepository::class,
            \App\Repositories\BilletRepositoryEloquent::class
        );

        $this->app->bind(
            \App\Repositories\CompanyRepository::class,
            \App\Repositories\CompanyRepositoryEloquent::class
        );

        $this->app->bind(
            \App\Repositories\ContactRepository::class,
            \App\Repositories\ContactRepositoryEloquent::class
        );

        $this->app->bind(
            \App\Repositories\TransactionRepository::class,
            \App\Repositories\TransactionRepositoryEloquent::class
        );
    }

}