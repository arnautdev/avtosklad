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
     * Read data
     */
    public function index()
    {

        $url = request()->apiUrl('cars/index');
        $resp = $this->curlExec($url);

        if (isset($resp->cars)) {
            $this->vars['cars'] = $resp->cars;
        }

        return $this->render('index');
    }


    /**
     * Create car
     * @throws \Exception
     */
    public function create()
    {
        if (request()->isPost()) {
            $data = $this->validateCarForm();
            $url = request()->apiUrl('cars/create');
            $resp = $this->curlExec($url, $data);
            if (isset($resp->carId)) {
                session()->set('flash', 'Success added car');
                return request()->redirectTo('cars');
            }
        }

        return $this->render('create');
    }


    /**
     * Edit car-info
     * @param null $carId
     */
    public function edit($carId = null)
    {
        if (is_null($carId)) {
            return request()->redirectTo('/cars');
        }


        if (request()->isPost()) {
            $data = $this->validateCarForm();
            $data['carId'] = $carId;

            $url = request()->apiUrl('cars/update');
            $resp = $this->curlExec($url, $data);
            if (isset($resp->statusUpdate) && $resp->statusUpdate == true) {
                session()->set('flash', 'Successfully update');
            }
        }

        $car = Car::where('id', '=', $carId)->first();
        if (!is_null($car)) {
            $this->vars['car'] = $car;
            $this->vars['carStore'] = $car->getCarStore()->first();
        }
//        var_dump($this->vars['carStore']);

        return $this->render('edit');
    }


    /**
     * Delete car
     * @param null $carId
     */
    public function delete($carId = null)
    {

    }


    /**
     * @return array|void
     */
    private function validateCarForm()
    {
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

        return $data;
    }
}