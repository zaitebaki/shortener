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
        $this->propsData['userLink'] = null;
        $this->propsData['shortLink'] = null;
        $this->propsData['statisticLink'] = null;
        $this->propsData['error'] = null;

        if (session()->has('userLink')) {
            $this->propsData['userLink'] = session()->get('userLink');
        }
        if (session()->has('shortLink')) {
            $this->propsData['shortLink'] = session()->get('shortLink');
        }
        if (session()->has('statisticLink')) {
            $this->propsData['statisticLink'] = session()->get('statisticLink');
        }
        if (session()->has('err')) {
            $this->propsData['error'] = session()->get('err');
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
        if (isset($data['newLink'])) {
            return redirect('/');
        }

        $userLink = $data['userUrl'];
        $date = strtotime($data['dataPicker']);

        $date = ($date === false) ? null : date('Y-m-d', $date);
        $shortLink = '';
        $statisticLink = '';

        // проверить url на валидность
        if (is_string($userLink) && strlen($userLink) < 2048 && UrlHandler::isValid($userLink)) {
            $token = UrlHandler::getNewToken();
            UrlHandler::saveUrl($userLink, $token, $date);
            $shortLink = env('APP_URL') . $token;
            $statisticLink = env('APP_URL') . $token . "/statistic";
            session()->flash('shortLink', $shortLink);
            session()->flash('statisticLink', $statisticLink);
        } else {
            $errorMessage = __('content.mainPage.errors.invalidUrl');
            session()->flash('err', $errorMessage);
        }
        session()->flash('userLink', $userLink);
        return redirect('/');
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
