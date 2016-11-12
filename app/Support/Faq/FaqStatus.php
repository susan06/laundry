<?php

namespace App\Support\Faq;

class FaqStatus
{
    const PUBLISHED = 'Published';
    const NOTPUBLISHED = 'No Published';

    public static function lists()
    {
        return [
            self::PUBLISHED => trans('app.'.self::PUBLISHED),
            self::NOTPUBLISHED => trans('app.'. self::NOTPUBLISHED)
        ];
    }
}