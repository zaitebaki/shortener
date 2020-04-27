<?php

namespace Tests\Unit\Helpers;

use App\Helpers\UrlHandler;
use Tests\TestCase;

class UrlHandlerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testIsValid()
    {
        $testStrings = [
            ['\r\n', false],
            ['    ', false],
            ['', false],
            ['www.hello', true],
            ['http://yandex.ru', true],
        ];

        for ($i = 0; $i < count($testStrings); $i++) {
            $str = $testStrings[$i][0];
            $result = $testStrings[$i][1];
            $this->assertEquals($result, UrlHandler::isValid($str));
        }
    }
}
