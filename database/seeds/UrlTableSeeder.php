<?php

use App\Url;
use Illuminate\Database\Seeder;

class UrlTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $urlsData = __('content.testData.urls');
        foreach ($urlsData as $url) {
            $newUrl = new Url($url);
            $newUrl->save();
        }
    }
}
