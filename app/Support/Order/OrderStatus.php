<?php

namespace App\Support\Order;

class OrderStatus
{
    const search = 'search';
    const recoge = 'recoge';
    const inbranch = 'inbranch';
    const branch_finish = 'branch_finish';
    const change_branch = 'change_branch';
    const via_branch = 'via_branch';
    const inexit = 'inexit';
    const delivered = 'delivered';

    public static function lists()
    {
        return [
            self::search => trans('app.'.self::search),
            self::recoge => trans('app.'. self::recoge),
            self::inbranch => trans('app.' . self::inbranch),
            self::inexit => trans('app.' . self::inexit),
            self::delivered => trans('app.' . self::delivered)
        ];
    }

    public static function listsDrivers()
    {
        return [
            self::search => trans('app.'.self::search),
            self::recoge => trans('app.'. self::recoge),
            self::inbranch => trans('app.' . self::inbranch),
            self::branch_finish => trans('app.' . self::branch_finish),
            self::change_branch => trans('app.' . self::change_branch),
            self::inexit => trans('app.' . self::inexit),
            self::branch_finish => trans('app.' . self::branch_finish)
        ];
    }
}