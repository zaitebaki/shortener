<?php

namespace App\Helpers;

use Hashids\Hashids;

class UrlHandler
{
    public static function isValid(string $url)
    {
        if (preg_match(
            "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",
            $url
        )) {
            return true;
        }
        return false;
    }

    public static function getNewToken(): string
    {
        $milliseconds = (int) round(microtime(true) * 1000);
        $hashids = new Hashids($milliseconds, 5);

        return $hashids->encode(1);
    }
}
