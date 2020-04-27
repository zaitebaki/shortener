<?php

if (!function_exists('create_urls')) {

    function create_urls(int $count = 3)
    {
        return $urls = factory(\App\Url::class, $count)->make();
    }
}
