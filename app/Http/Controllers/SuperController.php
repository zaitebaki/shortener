<?php

namespace App\Http\Controllers;

class SuperController extends Controller
{
    /**
     * Имя шаблона макета
     * @var string
     */
    protected $layout;

    /**
     * Заголовок страницы.
     * @var string
     */
    protected $title;

    /**
     * Массив переменных, которые передаются в шаблон.
     * @var array
     */
    protected $vars;

    /**
     * Контент отображаемого вида.
     * @var string
     */
    protected $content = '';

    public function __construct()
    {
    }

    /**
     * Сгенерировать вид
     * @return type
     */
    protected function renderOutput()
    {

        $this->vars = array_add($this->vars, 'title', $this->title);

        // передать в шаблон контентной части
        if ($this->content !== '') {
            $this->vars = array_add($this->vars, 'content', $this->content);
        }

        return view($this->layout)->with($this->vars);
    }
}
