<?php

namespace App\Repositories\Coupon;

use App\ClientCoupon;
use App\Repositories\Repository;

class EloquentClientCoupon extends Repository implements ClientCouponRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * EloquentPackage constructor
     *
     * @param Package $Package
     */
    public function __construct(ClientCoupon $clientCoupon)
    {
        parent::__construct($clientCoupon, $this->attributes);
    }

    //

}