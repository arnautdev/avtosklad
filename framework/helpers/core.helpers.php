<?php


if (!function_exists('request')) {

    function request()
    {
        return new \Framework\core\Request();
    }
}


if (!function_exists('session')) {

    function session()
    {
        return new \Symfony\Component\HttpFoundation\Session\Session();
    }
}