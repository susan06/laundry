<?php

namespace App\Support\Coupon;

class CouponStatus
{
    const VALID = 'Valid';
    const NOVALID = 'noValid';

    public static function lists()
    {
        return [
            self::VALID => trans('app.'.self::VALID),
            self::NOVALID => trans('app.'. self::NOVALID)
        ];
    }
}