<?php

namespace App\Repositories\Coupon;

use App\Coupon;
use App\Repositories\Repository;

class EloquentCoupon extends Repository implements CouponRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = ['code', 'validity', 'percentage'];

    /**
     * EloquentCoupon constructor
     *
     * @param Coupon $Coupon
     */
    public function __construct(Coupon $Coupon)
    {
        parent::__construct($Coupon, $this->attributes);
    }

}