<?php

namespace App\Http\Controllers;

class SuperController extends Controller
{
    /**
     * Имя шаблона макета.
     * @var string
     */
    protected $layout;

    /**
     * Заголовок страницы.
     * @var string
     */
    protected $title;

    /**
     * Данные для компонента.
     * @var array
     */
    protected $propsData = [];

    /**
     * Массив переменных, которые передаются в шаблон.
     * @var array
     */
    protected $vars;

    public function __construct()
    {
    }

    /**
     * Сгенерировать вид.
     * @return Illuminate\View\View
     */
    protected function renderOutput(): object
    {

        $this->vars = array_add($this->vars, 'title', $this->title);

        if (count($this->propsData) !== 0) {
            $this->vars = array_add($this->vars, 'propsData', $this->propsData);
        }

        return view($this->layout)->with($this->vars);
    }
}
