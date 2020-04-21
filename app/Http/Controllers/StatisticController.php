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

        $linkModels = $urlModel->statistic()->get();

        if ($linkModels->isEmpty()) {
            $this->propsData['links'] = null;
        } else {
            $links = [];
            $i = 0;
            foreach ($linkModels as $link) {
                $links[$i]['date'] = $link->date_time;
                $links[$i]['country'] = $link->country;
                $links[$i]['city'] = $link->city;
                $links[$i]['userAgent'] = $link->user_agent;
                $i++;
            }
            $this->propsData['links'] = $links;
        }

        $this->propsData['currentLink'] = env('APP_URL') . $token;
        return $this->renderOutput();
    }
}
