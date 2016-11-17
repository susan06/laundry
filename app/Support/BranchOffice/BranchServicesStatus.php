<?php

namespace App\Support\BranchOffice;

class BranchServicesStatus
{
    const AVAILABLE = 'Available';
    const NOTAVAILABLE = 'Not available';

    public static function lists()
    {
        return [
            self::AVAILABLE => trans('app.'.self::AVAILABLE),
            self::NOTAVAILABLE => trans('app.'. self::NOTAVAILABLE)
        ];
    }
}