<?php

namespace App\Http\Controllers;

use App\Helpers\UrlHandler;
use Hashids\Hashids;
use Illuminate\Http\Request;

class IndexController extends SuperController
{

    public function __construct()
    {
        $this->title = __('content.mainPage.title');
        $this->layout = "index";
        $this->propsData = [
            'indexRoute' => route('handleLinkForm'),
        ];
    }

    public function index()
    {
        // if (!session()->has('typeForm')) {
        //     session(['typeForm' => 'login']);
        // }

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

    public function handleRequest(Request $request)
    {
        $data = $request->all();

        $userLink = $data['userUrl'];
        $shortLink = '';

        // проверить url на валидность
        if (UrlHandler::isValid($userLink)) {
            $token = UrlHandler::getShortToken($userLink);

            $milliseconds = (int) round(microtime(true) * 1000);

            $d = $userLink . $milliseconds;
            $hashids = new Hashids($userLink . $milliseconds, 5);

            $shortLink = env('APP_URL') . $hashids->encode(1);
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
}
