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

    /**
     * Получить токен для URL.
     *  @param string $url
     *  @return string
     */
    public static function getShortToken(string $url): string
    {
        $currentToken = config('data.currentToken');

        $smbArrays = require_once 'token-array.php';

        $countZ = 0;
        for ($i = 4; $i > 0; $i--) {
            if ($currentToken === 'Z') {
                $countZ++;
            } else {
                break;
            }
        }

        for ($i = 0, $j = 4; $i < $countZ; $i++, $j--) {
            $currentToken[$j] = $smbArrays['smbOrder'][0];
        }

        $incrementSmb = $currentToken[4 - $countZ];
        $newOrderNumber = $smbArrays['smbValuesArray'][$incrementSmb];
        $currentToken[4 - $countZ] = $smbArrays['smbOrder'][$newOrderNumber];

        config(['data.currentToken' => $currentToken]);

        return $currentToken;
    }
}
