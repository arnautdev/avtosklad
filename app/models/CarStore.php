<?php

namespace App\models;

use App\models\Car;

class CarStore extends AppModel
{

    /**
     * @var array
     */
    public $fillable = [
        'carId',
        'availableCount'
    ];


    /**
     * Get car
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCar()
    {
        return $this->belongsTo(Car::class, 'carId', 'id');
    }
}