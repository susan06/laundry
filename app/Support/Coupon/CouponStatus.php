<?php

namespace App\Support\Coupon;

class CouponStatus
{
    const VALID = 'Valid';
    const USELESS = 'Useless';

    public static function lists()
    {
        return [
            self::VALID => trans('app.'.self::VALID),
            self::USELESS => trans('app.'. self::USELESS)
        ];
    }
}