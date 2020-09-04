<?php

namespace DigiSac\Base\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            \DigiSac\Base\Repositories\AccessAuthorizationRepository::class,
            \DigiSac\Base\Repositories\AccessAuthorizationRepositoryEloquent::class
        );

        $this->app->bind(
            \DigiSac\Base\Repositories\BilletRepository::class,
            \DigiSac\Base\Repositories\BilletRepositoryEloquent::class
        );

        $this->app->bind(
            \DigiSac\Base\Repositories\CompanyRepository::class,
            \DigiSac\Base\Repositories\CompanyRepositoryEloquent::class
        );

        $this->app->bind(
            \DigiSac\Base\Repositories\ContactRepository::class,
            \DigiSac\Base\Repositories\ContactRepositoryEloquent::class
        );

        $this->app->bind(
            \DigiSac\Base\Repositories\TransactionRepository::class,
            \DigiSac\Base\Repositories\TransactionRepositoryEloquent::class
        );

        $this->app->bind(
            \DigiSac\Base\Repositories\SendRequestRepository::class,
            \DigiSac\Base\Repositories\SendRequestRepositoryEloquent::class
        );
    }

}
