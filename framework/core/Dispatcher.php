<?php

namespace Framework\core;


class Dispatcher
{
    private $phSelf = [];

    /**
     * @var string
     */
    public $controller = 'Default';

    /**
     * @var string
     */
    public $action = 'index';

    /**
     * @var array
     */
    public $args = [];


    /**
     * @throws \Exception
     */
    public function run()
    {
        $controller = 'App\\controllers\\' . $this->getController() . 'Controller';
        $action = $this->getAction();

        if (!class_exists($controller)) {
            throw new \Exception($controller . ' not exists');
        }

        $args = $this->getArgs();
        $controller = new $controller();
        $controller->$action(...$args);
    }


    /**
     * Get controller
     * @return string
     */
    public function getController()
    {
        $phpSelf = request()->server('PHP_SELF');
        $phpSelf = explode('/', $phpSelf);
        $phpSelf = array_filter($phpSelf);

        foreach ($phpSelf as $key => $val) {
            if ($val != 'index.php') {
                unset($phpSelf[$key]);
            } elseif ($val == 'index.php') {
                unset($phpSelf[$key]);
                break;
            }
        }

        $this->phSelf = $phpSelf;
        $controller = array_shift($this->phSelf);
        if (!is_null($controller)) {
            $controller = strtolower($controller);
            $this->controller = ucfirst($controller);
        }

        return $this->controller;
    }

    /**
     * Get action
     * @return mixed|string
     */
    public function getAction()
    {
        $action = array_shift($this->phSelf);
        if (!is_null($action)) {
            $this->action = $action;
        }

        return $this->action;
    }


    /**
     * Get args
     * @return array|null
     */
    public function getArgs()
    {
        if (!empty($this->phSelf)) {
            return $this->phSelf;
        }
        return [];
    }
}