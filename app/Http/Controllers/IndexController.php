<?php

namespace App\Http\Controllers;

class IndexController extends SuperController
{
    public function __construct()
    {
        parent::__construct();
        $this->title  = __('content.title');
        $this->layout = ".route.main";
    }

    public function index()
    {
        // if (!session()->has('typeForm')) {
        //     session(['typeForm' => 'login']);
        // }


        $this->content = view('index')->render();
        return $this->renderOutput();
    }
}
