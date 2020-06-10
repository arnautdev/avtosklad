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
        if (!$this->hasPermission('cars.index')) {
            return $this->throwError(INVALID_PERMISSION, 'You dont have permissions for this action');
        }

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
        if (!$this->hasPermission('cars.create')) {
            return $this->throwError(INVALID_PERMISSION, 'You dont have permissions for this action');
        }

        $data = $_POST;
        $car = Car::create($data);
        if ($car->id) {
            return $this->returnResponse([
                'carId' => $car->id
            ]);
        }

        return $this->throwError(GENERAL_ERROR, 'Something wrong');
    }


    /**
     * @return int
     */
    public function update()
    {
        if (!$this->hasPermission('cars.update')) {
            return $this->throwError(INVALID_PERMISSION, 'You dont have permissions for this action');
        }
        $data = $_POST;
        if (!isset($data['carId']) || intval($data['carId']) == 0) {
            return $this->throwError(GENERAL_ERROR, 'Invalid car id');
        }

        $car = Car::where('id', '=', $data['carId'])->first();
        if ($car->update($data)) {
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
        if (!$this->hasPermission('cars.delete')) {
            return $this->throwError(INVALID_PERMISSION, 'You dont have permissions for this action');
        }
    }
}