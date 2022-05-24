<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Interfaces\Auth\LoginRepositoryInterface;
use App\Repositories\Auth\LoginRepository;
use App\Interfaces\Role\RoleRepositoryInterface;
use App\Repositories\Role\RoleRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(LoginRepositoryInterface::class, LoginRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
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
