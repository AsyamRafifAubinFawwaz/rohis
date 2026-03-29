<?php

namespace App\Constants;

class ActivitiesStatusConst
{
    const UPCOMING = 'upcoming';
    const DONE = 'done';

    public static function getList()
    {
        return [
            self::UPCOMING => 'Upcoming',
            self::DONE => 'Done',
        ];
    }
}
