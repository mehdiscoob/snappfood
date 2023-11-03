<?php

namespace App\Providers;

use App\Repositories\order\OrderRepository;
use App\Repositories\order\OrderRepositoryInterface;
use App\Repositories\user\UserRepository;
use App\Repositories\user\UserRepositoryInterface;
use App\Repositories\vendor\VendorRepository;
use App\Repositories\vendor\VendorRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(VendorRepositoryInterface::class, VendorRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
