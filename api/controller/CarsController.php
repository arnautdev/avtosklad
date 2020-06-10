<?php
/**
 * Created by PhpStorm.
 * User: credissimo
 * Date: 6/4/20
 * Time: 2:39 PM
 */

namespace Api\controller;


use App\models\Car;
use App\traits\UtilsAwareTrait;

class CarsController extends ApiController
{
    use UtilsAwareTrait;

    /**
     * Get all cars
     * @return Car[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $data['cars'] = Car::all()->map(function ($row) {
            $addedBy = $row->getUser()->first();
            if (!is_null($addedBy)) {
                $userName = $addedBy->name;
            }

            return [
                'id' => $row->id,
                'created_at' => $this->sqlDate($row->created_at)->format('Y-m-d'),
                'created_by' => $userName,
                'brand' => $row->brand,
                'model' => $row->model,
                'issueYear' => $row->issueYear,
            ];
        });


        return $this->returnResponse($data);
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
            $car->initStorage([
                'availableCount' => $data['availableCount']
            ]);

            return $this->returnResponse([
                'carId' => $car->id
            ]);
        }

        return $this->throwError(GENERAL_ERROR, 'Something wrong');
    }


    /**
     * Update car-info
     * @return int
     */
    public function update()
    {
        $data = $_POST;
        if (!isset($data['carId']) || intval($data['carId']) == 0) {
            return $this->throwError(GENERAL_ERROR, 'Invalid car id');
        }

        $car = Car::where('id', '=', $data['carId'])->first();
        if ($car->update($data)) {
            $carStoreData = [
                'availableCount' => $data['availableCount']
            ];
            $carStore = $car->getCarStore()->first();
            if (is_null($carStore)) {
                $car->initStorage($carStoreData);
                $carStore = $car->getCarStore()->first();
            }
            $carStore->update($carStoreData);

            return $this->returnResponse([
                'statusUpdate' => true
            ]);
        }

        return $this->throwError(GENERAL_ERROR, 'Something wrong');
    }

    /**
     * @return int
     */
    public function delete()
    {

    }
}