<?php

namespace Framework\core;


use App\traits\AclAwareTrait;

class Dispatcher
{
    use AclAwareTrait;

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
     * @var string
     */
    public $namespace = null;

    /**
     * Dispatcher constructor.
     * @param string $namespace
     */
    public function __construct($namespace = null)
    {
        $this->namespace = $namespace;
    }


    /**
     * @throws \Exception
     */
    public function run()
    {
        $controller = 'App\\controller\\' . $this->getController() . 'Controller';
        /// when calling from api change controller namespace
        if (!is_null($this->namespace)) {
            $controller = 'Api\\controller\\' . $this->getController() . 'Controller';
        }

        $action = $this->getAction();

        if (!class_exists($controller)) {
            throw new \Exception($controller . ' not exists');
        }

        $args = $this->getArgs();
        $controller = new $controller();

        /// check for permissions
        $permissionController = strtolower($this->getController());
        $permission = $permissionController . '.' . $action;
        $hasPermission = $this->hasPermission($permission);
        if (!$hasPermission && !in_array($permissionController, ['default', 'user', 'login'])) {
            session()->set('flash', 'You dont have access for this action: ' . $permission);
            return request()->redirectTo('/');
        }


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