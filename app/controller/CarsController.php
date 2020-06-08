<?php

namespace App\controller;


use App\traits\CurlAwareTrait;
use Rakit\Validation\Validator;

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
        if (request()->isPost()) {
            $validator = new Validator();
            $validation = $validator->make($_POST, [
                'brand' => 'required',
                'model' => 'required',
                'issueYear' => 'required',
                'equipment' => 'required',
                'status' => 'required',
                'availableCount' => 'required',
                'technicalSpecifications' => 'required',
            ]);
            $validation->validate();

            if ($validation->fails()) {
                $this->vars['erros'] = $validation->errors();
                return $this->render('create');
            }
        }

        return $this->render('create');
    }
}