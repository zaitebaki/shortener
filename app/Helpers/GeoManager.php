<?php

namespace App\Helpers;

class GeoManager
{

    public static function getCountryAndCity()
    {
        $ip = '';
        $dumpIp = '';

        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $dumpIp = $_SERVER['HTTP_CLIENT_IP'];
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                $ip = $dumpIp;
            }
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $dumpIp = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var($dumpIp, FILTER_VALIDATE_IP)) {
                $ip = $dumpIp;
            }
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $ip = "176.59.74.235";
        $ipData = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));

        $result = array(null, null);

        if ($ipData->geoplugin_countryName) {
            $result[0] = $ipData->geoplugin_countryName;
        }
        if ($ipData->geoplugin_city) {
            $result[1] = $ipData->geoplugin_city;
        }

        return $result;
    }
}
