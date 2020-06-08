<?php

namespace Framework\database;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{

    public function __construct()
    {
        $capsule = new Capsule();
        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'avtosklad',
            'username' => 'root',
            'password' => 'none',
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
        ]);

        $capsule->bootEloquent();
    }
}