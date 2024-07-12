<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ExpensesRepository;
use App\Repositories\Interfaces\ExpensesRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ExpensesRepositoryInterface::class,
            ExpensesRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
