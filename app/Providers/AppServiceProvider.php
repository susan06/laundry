<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\User\EloquentUser;
use App\Repositories\User\UserRepository;

use App\Repositories\Role\EloquentRole;
use App\Repositories\Role\RoleRepository;

use App\Repositories\Coupon\EloquentCoupon;
use App\Repositories\Coupon\CouponRepository;

use App\Repositories\BranchOffice\EloquentBranchOffice;
use App\Repositories\BranchOffice\BranchOfficeRepository;


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
        $this->app->singleton(CouponRepository::class, EloquentCoupon::class);
        $this->app->singleton(BranchOfficeRepository::class, EloquentBranchOffice::class);
    }
}
