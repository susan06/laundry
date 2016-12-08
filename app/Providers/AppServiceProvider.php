<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\User\EloquentUser;
use App\Repositories\User\UserRepository;

use App\Repositories\Role\EloquentRole;
use App\Repositories\Role\RoleRepository;

use App\Repositories\Coupon\EloquentCoupon;
use App\Repositories\Coupon\CouponRepository;

use App\Repositories\Coupon\EloquentClientCoupon;
use App\Repositories\Coupon\ClientCouponRepository;

use App\Repositories\BranchOffice\EloquentBranchOffice;
use App\Repositories\BranchOffice\BranchOfficeRepository;

use App\Repositories\Faq\EloquentFaq;
use App\Repositories\Faq\FaqRepository;

use App\Repositories\Subscriber\EloquentSubscriber;
use App\Repositories\Subscriber\SubscriberRepository;

use App\Repositories\Client\EloquentClient;
use App\Repositories\Client\ClientRepository;

use App\Repositories\Client\EloquentClientLocation;
use App\Repositories\Client\ClientLocationRepository;

use App\Repositories\Package\EloquentPackage;
use App\Repositories\Package\PackageRepository;

use App\Repositories\Package\EloquentPackagePrice;
use App\Repositories\Package\PackagePriceRepository;

use App\Repositories\Package\EloquentPackageCategory;
use App\Repositories\Package\PackageCategoryRepository;

use App\Repositories\Order\EloquentOrder;
use App\Repositories\Order\OrderRepository;

use App\Repositories\Order\EloquentOrderPayment;
use App\Repositories\Order\OrderPaymentRepository;

use App\Repositories\Order\EloquentOrderPackage;
use App\Repositories\Order\OrderPackageRepository;

use App\Repositories\Payment\EloquentPayment;
use App\Repositories\Payment\PaymentRepository;

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
        $this->app->singleton(ClientCouponRepository::class, EloquentClientCoupon::class);
        $this->app->singleton(BranchOfficeRepository::class, EloquentBranchOffice::class);
        $this->app->singleton(FaqRepository::class, EloquentFaq::class);
        $this->app->singleton(SubscriberRepository::class, EloquentSubscriber::class);
        $this->app->singleton(ClientRepository::class, EloquentClient::class);
        $this->app->singleton(ClientLocationRepository::class, EloquentClientLocation::class);
        $this->app->singleton(PackageRepository::class, EloquentPackage::class);
        $this->app->singleton(PackagePriceRepository::class, EloquentPackagePrice::class);
        $this->app->singleton(PackageCategoryRepository::class, EloquentPackageCategory::class);
        $this->app->singleton(OrderRepository::class, EloquentOrder::class);
        $this->app->singleton(OrderPaymentRepository::class, EloquentOrderPayment::class);
        $this->app->singleton(OrderPackageRepository::class, EloquentOrderPackage::class);
        $this->app->singleton(PaymentRepository::class, EloquentPayment::class);
    }
}
