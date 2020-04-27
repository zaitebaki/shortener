<?php

use App\Statistic;
use Illuminate\Database\Seeder;

class StatisticTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statisticData = __('content.testData.statistic');
        foreach ($statisticData as $link) {
            $newLink = new Statistic($link);
            $newLink->save();
        }
    }
}
