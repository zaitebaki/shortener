<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class StaticControllerTest extends TestCase
{
    public function testGetStatistic()
    {
        $response = $this->get('/11111/statistic');
        $response->assertStatus(200);

        $response = $this->get('/22222/statistic');
        $response->assertStatus(404);
    }
}
