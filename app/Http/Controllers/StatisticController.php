<?php

namespace App\Http\Controllers;

use App\Helpers\UrlHandler;
use App\Url;

class StatisticController extends SuperController
{
    /**
     * Инициализация контроллера StatisticController.
     */
    public function __construct()
    {
        $this->title = __('content.statisticPage.title');
        $this->layout = "statistic";
        // $this->propsData = [
        //     'indexRoute' => route('getShortLink'),
        // ];
    }

    /**
     * Обработать GET-запрос для получения статистики.
     * @param string $token
     */
    public function getStatistic(string $token)
    {
        if (strlen($token) !== 5) {
            abort(404);
        }

        $urlModel = Url::where('token', '=', $token)->firstOrFail();
        $isActive = UrlHandler::isActive($urlModel->lifetime);

        if (!$isActive) {
            abort(404);
        }

        // $this->propsData

        return $this->renderOutput();
    }
}
