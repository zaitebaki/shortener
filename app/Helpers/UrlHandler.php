<?php

namespace App\Helpers;

use App\Url;
use Hashids\Hashids;

class UrlHandler
{
    /**
     * Валидация URL.
     * @param string $url
     * @return bool
     */
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
     * Получить новый токен.
     * @return string
     */
    public static function getNewToken(): string
    {
        $milliseconds = (int) round(microtime(true) * 1000);
        $hashids = new Hashids($milliseconds, 5);

        return $hashids->encode(1);
    }

    /**
     * Получить новый токен.
     * @param string $url
     * @param string $token
     *
     * @return void
     */
    public static function saveUrl($url, $token): void
    {
        $newUrl = [
            'url' => $url,
            'token' => $token,
        ];

        $newUrl = new Url($newUrl);
        $newUrl->save();
    }
}
