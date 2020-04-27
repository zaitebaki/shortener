<?php

namespace Tests\Feature\Http\Controllers;

use App\Helpers\UrlHandler;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{

    public function testIndexException()
    {
        $response = $this->get('/test');
        $response->assertStatus(404);
    }

    public function testIndex()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testGetShortLink()
    {
        $data =
            [
            "newLink" => null,
            "userUrl" => "https://www.php.net/manual/ru/reserved.variables.post.php",
            "dataPicker" => date("Y-m-d"),
        ];

        $token = UrlHandler::getNewToken();

        $response = $this->post('/', $data)
            ->assertSessionHas('shortLink')
            ->assertSessionHas('statisticLink')
            ->assertSessionHas('userLink')
            ->assertStatus(302)
            ->assertRedirect('/');

        $this->followRedirects($response)
            ->assertSee('Короткая ссылка');
    }

    public function testGetShortLinkWithError()
    {
        $data =
            [
            "newLink" => null,
            "userUrl" => "test",
            "dataPicker" => '',
        ];

        $token = UrlHandler::getNewToken();

        $response = $this->post('/', $data)
            ->assertSessionHas('err')
            ->assertSessionHas('userLink')
            ->assertStatus(302)
            ->assertRedirect('/');

        $this->followRedirects($response)
            ->assertSee('Сервис не поддерживает указанный тип URL');
    }

    public function testRedirect()
    {
        $_SERVER['HTTP_USER_AGENT'] = 'test server';
        $response = $this->get('/00000');
        $response->assertStatus(302);
        $response = $this->get('/11111');
        $response->assertStatus(302);
        $response = $this->get('/22222');
        $response->assertStatus(404);
    }
}
