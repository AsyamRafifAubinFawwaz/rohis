<?php

namespace App\Constants;

class UserConst
{
    const SUPERADMIN = 1;

    const ADMIN = 2;

    public static function getAccessTypes()
    {
        return [
            self::SUPERADMIN => 'Super Admin',
            self::ADMIN => 'Admin',
        ];
    }
}
