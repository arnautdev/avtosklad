<?php
/**
 * Created by PhpStorm.
 * User: credissimo
 * Date: 6/4/20
 * Time: 10:41 AM
 */

namespace App\controller;


class DefaultController extends AppController
{

    /**
     *
     */
    public function index()
    {

        $this->render('index');
    }
}