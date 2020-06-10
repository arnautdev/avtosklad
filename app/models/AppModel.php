<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as Capsule;

class AppModel extends Model
{

    /**
     * AppModel constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $capsule = new Capsule();
        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'database' => 'avtosklad',
            'username' => 'root',
            'password' => 'none',
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

}