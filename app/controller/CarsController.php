<?php

namespace App\controller;


use App\traits\CurlAwareTrait;
use App\traits\UtilsAwareTrait;
use Rakit\Validation\Validator;
use App\models\Car;

class CarsController extends AppController
{

    use CurlAwareTrait, UtilsAwareTrait;

    /**
     *
     */
    public function index()
    {

        $url = request()->apiUrl('cars/get');
        $resp = $this->curlExec($url);

        $this->vars['cars'] = $resp->cars;
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
            $data['addedByAdminId'] = session()->get('user')->id;
            $data['technicalSpecifications'] = json_encode($data['technicalSpecifications']);

            $url = request()->apiUrl('cars/create');
            $resp = $this->curlExec($url, $data);
            if (isset($resp->carId)) {
                session()->set('flash', 'Success added car');
                return request()->redirectTo('cars');
            }

        }

        return $this->render('create');
    }
}