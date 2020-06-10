<?php

namespace App\controller;

use App\traits\AclAwareTrait;

class AppController
{
    use AclAwareTrait;

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
     * @var bool
     */
    public $checkAuth = true;

    /**
     * AppController constructor.
     */
    public function __construct()
    {
        if ($this->checkAuth && !session()->has('user')) {
            return request()->redirectTo('user/login');
        }
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