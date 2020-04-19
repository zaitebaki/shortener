<?php

namespace App\Http\Controllers;

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

        return $this->renderOutput();
    }

    public function handleRequest(Request $request)
    {
        $data = $request->all();

        $userLink = $data['userUrl'];
        $shortLink = 'short link';

        // $res = filter_var($userLink, FILTER_VALIDATE_URL);

        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $userLink)) {
            dd('error');
        } else {
            dd("good");
        }

        session(['userLink' => $userLink]);
        session(['shortLink' => $shortLink]);

        $this->propsData['userLink'] = $userLink;
        $this->propsData['shortLink'] = $shortLink;

        return $this->renderOutput();
    }
}
