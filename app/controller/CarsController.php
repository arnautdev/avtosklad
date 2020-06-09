<?php

namespace App\controller;


use App\traits\CurlAwareTrait;
use App\traits\UtilsAwareTrait;
use Rakit\Validation\Validator;

class CarsController extends AppController
{

    use CurlAwareTrait, UtilsAwareTrait;

    /**
     *
     */
    public function index()
    {

        return $this->render('index');
    }


    /**
     * Create car
     */
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

            /// get valid data
            $data = $validation->getValidData();
            $data['issueYear'] = $this->sqlDate($data['issueYear'])->format('Y-m-d');

            $request = request()->apiUrl('login');
            $resp = $this->curlExec($request, [
                'email' => 'dmitrii.arnaut@gmail.com',
                'password' => 'dmitrii.arnaut@gmail.com'
            ]);
            $resp = json_decode($resp);
            var_dump(__METHOD__);
            die(var_dump($resp));
        }

        return $this->render('create');
    }
}