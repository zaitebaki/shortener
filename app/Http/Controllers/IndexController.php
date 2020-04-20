<?php

namespace App\Http\Controllers;

use App\Helpers\UrlHandler;
use App\Url;
use Illuminate\Http\Request;
use Redirect;

class IndexController extends SuperController
{
    /**
     * Инициализация контроллера IndexController.
     */
    public function __construct()
    {
        $this->title = __('content.mainPage.title');
        $this->layout = "index";
        $this->propsData = [
            'indexRoute' => route('getShortLink'),
        ];
    }

    /**
     * Обработать GET-запрос для роутера '/'.
     * @return void
     * @return Illuminate\View\View
     */
    public function index(): object
    {
        if (session()->has('userLink')) {
            $this->propsData['userLink'] = session()->get('userLink');
        }

        if (session()->has('shortLink')) {
            $this->propsData['shortLink'] = session()->get('shortLink');
        }

        if (session()->has('err')) {
            $this->propsData['err'] = session()->get('err');
        }
        return $this->renderOutput();
    }

    /**
     * Получить короткую ссылку.
     * @param Illuminate\Http\Request $request
     * @return Illuminate\View\View
     */
    public function getShortLink(Request $request): object
    {
        $data = $request->all();
        $userLink = $data['userUrl'];
        $date = $data['dataPicker'];

        $date = date('Y-m-d', (strtotime($date)));
        $shortLink = '';

        // проверить url на валидность
        if (UrlHandler::isValid($userLink)) {
            $token = UrlHandler::getNewToken();

            UrlHandler::saveUrl($userLink, $token, $date);

            $shortLink = env('APP_URL') . $token;
        } else {
            session(['err' => __('content.errors.mainPage.invalidUrl')]);
            $this->propsData['error'] = __('content.mainPage.errors.invalidUrl');
        }

        session(['userLink' => $userLink]);
        session(['shortLink' => $shortLink]);

        $this->propsData['userLink'] = $userLink;
        $this->propsData['shortLink'] = $shortLink;

        return $this->renderOutput();
    }

    /**
     * Получить короткую ссылку.
     * @param Illuminate\Http\Request $request
     * @return Illuminate\View\View
     */
    public function redirect($token)
    {
        if (strlen($token) === 5) {
            $model = Url::where('token', '=', $token)->firstOrFail();

            $date = strtotime($model->lifetime) + 86400;

            if ($date !== 0 && $date < time()) {
                abort(404);
            }

            return Redirect::away($model->url);
        }

        abort('404');
    }
}
