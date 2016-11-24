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

use App\Repositories\Faq\EloquentFaq;
use App\Repositories\Faq\FaqRepository;

use App\Repositories\Subscriber\EloquentSubscriber;
use App\Repositories\Subscriber\SubscriberRepository;

use App\Repositories\Client\EloquentClient;
use App\Repositories\Client\ClientRepository;

use App\Repositories\Package\EloquentPackage;
use App\Repositories\Package\PackageRepository;

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
        $this->app->singleton(FaqRepository::class, EloquentFaq::class);
        $this->app->singleton(SubscriberRepository::class, EloquentSubscriber::class);
        $this->app->singleton(ClientRepository::class, EloquentClient::class);
        $this->app->singleton(PackageRepository::class, EloquentPackage::class);
    }
}
