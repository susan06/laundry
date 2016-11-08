<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\User\EloquentUser;
use App\Repositories\User\UserRepository;

use App\Repositories\Role\EloquentRole;
use App\Repositories\Role\RoleRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepository::class, EloquentUser::class);
        $this->app->singleton(RoleRepository::class, EloquentRole::class);
    }
}
