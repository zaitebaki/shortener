<?php

namespace App\Helpers;

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

    /**
     * Получить токен для url
     * @param string $url
     * 
     * @return string
     */
    public static function getShortToken(string $url): string
    {
        return '00001';
    }
}
