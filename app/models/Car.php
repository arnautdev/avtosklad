<?php
/**
 * Created by PhpStorm.
 * User: credissimo
 * Date: 6/4/20
 * Time: 2:00 PM
 */

namespace App\models;

use App\models\CarStore;

class Car extends AppModel
{

    /**
     * @var array
     */
    public $fillable = [
        'brand',
        'model',
        'issueYear',
        'equipment',
        'technicalSpecifications',
        'status',
        'addedByAdminId',
    ];

    /**
     * Get car store
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getCarStore()
    {
        return $this->hasOne(CarStore::class, 'carId', 'id');
    }
}