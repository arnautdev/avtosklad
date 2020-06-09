<?php
/**
 * Created by PhpStorm.
 * User: credissimo
 * Date: 6/4/20
 * Time: 2:39 PM
 */

namespace Api\controller;


use App\models\Car;

class CarsController extends ApiController
{

    /**
     * Get all cars
     * @return Car[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get()
    {
        $data['cars'] = Car::all();
        return  $this->returnResponse($data);
    }


    /**
     * Create car
     * @return int
     */
    public function create()
    {
        $data = $_POST;

        $car = Car::create($data);
        if ($car->id) {
            return $this->returnResponse([
                'carId' => $car->id
            ]);
        }

        return $this->throwError(2000, 'Something wrong');
    }


    public function view()
    {

    }

    public function delete()
    {

    }
}