<?php

namespace App\controller;


use App\traits\CurlAwareTrait;

class CarsController extends AppController
{

    use CurlAwareTrait;

    /**
     *
     */
    public function index()
    {

        return $this->render('index');
    }


    public function create()
    {
        return $this->render('create');
    }
}