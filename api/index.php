<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// require composer autoload
require_once(__DIR__ . '../../vendor/autoload.php');


// require core.helpers
require_once(__DIR__ . '../../framework/helpers/core.helpers.php');

/// define vars
define('ROOT', __DIR__);

define('VIEWS', __DIR__ . '/app/view/api');

try {
    $dispatcher = new \Framework\core\Dispatcher('api');
    $dispatcher->run();
} catch (\Exception $e) {
    echo $e->getFile() . '<br />';
    echo $e->getMessage() . '<br />';
    exit;
}