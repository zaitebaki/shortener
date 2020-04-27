<?php

use App\Url;
use Carbon\Carbon;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Url::class, function (Faker $faker) {
    return [
        'token' => Str::random(5),
        'url' => "http://" . Str::random(10),
        'lifetime' => date('Y-m-d', Carbon::now()->timestamp),
    ];
});
