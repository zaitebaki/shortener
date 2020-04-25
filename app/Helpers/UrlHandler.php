<?php

namespace App\Helpers;

use App\Statistic;
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
            "/[\n\r]/",
            $url
        )) {
            return false;
        }

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
     * @param string $date
     *
     * @return void
     */
    public static function saveUrl($url, $token, $date): void
    {
        $newUrl = [
            'url' => $url,
            'token' => $token,
            'lifetime' => $date,
        ];

        $newUrl = new Url($newUrl);
        $newUrl->save();
    }

    /**
     * Проверить является ли ссылка активной
     * @param string $lifeTimeUrl
     *
     * @return bool
     */
    public static function isActive($lifeTimeUrl): bool
    {
        if ($lifeTimeUrl === null) {
            return true;
        }

        $date = strtotime($lifeTimeUrl);

        if ($date + 86400 < time()) {
            return false;
        }

        return true;
    }

    /**
     * Сохранить статистику перехода.
     * @param App\Url $urlModel
     * @param string $date
     * @param string $country
     * @param string $city
     *      * @return void
     */
    public static function saveStatistic(
        $urlModel,
        string $date,
        string $country = null,
        string $city = null
    ): void {
        $newStatistic = [
            'date_time' => $date,
            'country' => $country,
            'city' => $city,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
        ];

        $newStatistic = new Statistic($newStatistic);
        $urlModel->statistic()->save($newStatistic);
    }
}
