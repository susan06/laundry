<?php

namespace App\Support\Order;

class OrderStatus
{
    const search = 'search';
    const recoge = 'recoge';
    const inbranch = 'inbranch';
    const inexit = 'inexit';

    public static function lists()
    {
        return [
            self::search => trans('app.'.self::search),
            self::recoge => trans('app.'. self::recoge),
            self::inbranch => trans('app.' . self::inbranch),
            self::inexit => trans('app.' . self::inexit)
        ];
    }
}