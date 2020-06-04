<?php

namespace App\controllers;

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

        require('');
    }
}