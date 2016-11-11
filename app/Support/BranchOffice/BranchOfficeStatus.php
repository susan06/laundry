<?php

namespace App\Support\BranchOffice;

class BranchOfficeStatus
{
    const SERVICE = 'In service';
    const OUTSERVICE = 'Out of service';

    public static function lists()
    {
        return [
            self::SERVICE => trans('app.'.self::SERVICE),
            self::OUTSERVICE => trans('app.'. self::OUTSERVICE)
        ];
    }
}