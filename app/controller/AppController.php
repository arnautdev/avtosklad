<?php

namespace App\controller;

class AppController
{
    /**
     * View vars
     * @var array
     */
    public $vars = [];

    /**
     * @var string
     */
    public $layout = 'default';


    /**
     * AppController constructor.
     */
    public function __construct()
    {
    }

    /**
     * Set/add view vars
     * @param $d
     */
    public function set($d)
    {
        $this->vars = array_merge($this->vars, $d);
    }

    /**
     * @param string $view
     */
    public function render($view = 'default')
    {
        extract($this->vars);
        ob_start();

        $controller = explode('\\', get_class($this));
        $controller = end($controller);
        $controller = strtolower(str_replace('Controller', '', $controller));

        require(VIEWS . $controller . '/' . $view . '.php');
        $contentForLayout = ob_get_clean();

        if ($this->layout === false) {
            $contentForLayout;
        } else {
            require(VIEWS . 'Layout/default.php');
        }
    }
}