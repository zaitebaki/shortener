<?php

namespace App\Http\Controllers;

use App\Helpers\GeoManager;
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
        $this->propsData['shortLink'] = null;
        $this->propsData['error'] = null;
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

        if (isset($data['newLink'])) {
            return redirect('/');
        }

        $userLink = $data['userUrl'];
        $date = strtotime($data['dataPicker']);

        $date = ($date === false) ? null : date('Y-m-d', $date);
        $shortLink = '';
        $statisticLink = '';

        // проверить url на валидность
        if (UrlHandler::isValid($userLink)) {
            $token = UrlHandler::getNewToken();
            UrlHandler::saveUrl($userLink, $token, $date);
            $shortLink = env('APP_URL') . $token;
            $statisticLink = env('APP_URL') . $token . "/statistic";
            $this->propsData['error'] = null;
        } else {
            session(['err' => __('content.errors.mainPage.invalidUrl')]);
            $this->propsData['error'] = __('content.mainPage.errors.invalidUrl');
        }

        session(['userLink', $userLink]);
        session(['shortLink', $shortLink]);
        session(['statisticLink', $statisticLink]);

        $this->propsData['userLink'] = $userLink;
        $this->propsData['shortLink'] = $shortLink;
        $this->propsData['statisticLink'] = $statisticLink;

        return $this->renderOutput();
    }

    /**
     * Перенаправить пользователя по короткой ссылке.
     * @param string $token
     */
    public function redirect(string $token)
    {
        if (strlen($token) !== 5) {
            abort('404');
        }

        $urlModel = Url::where('token', '=', $token)->firstOrFail();
        $isActive = UrlHandler::isActive($urlModel->lifetime);

        if (!$isActive) {
            abort(404);
        }

        $date = date("Y-m-d H:i:s");
        list($country, $city) = GeoManager::getCountryAndCity();
        UrlHandler::saveStatistic($urlModel, $date, $country, $city);

        return Redirect::away($urlModel->url);
    }
}
