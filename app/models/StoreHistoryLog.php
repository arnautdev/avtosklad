<?php

namespace App\models;


use Illuminate\Database\Eloquent\SoftDeletes;

class StoreHistoryLog extends AppModel
{
    use SoftDeletes;

    /**
     * @var array
     */
    public $fillable = [
        'carId',
        'availableCount',
        'status',
        'addedByAdminId',
    ];


    /**
     * Get car
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCar()
    {
        return $this->belongsTo(Car::class, 'carId', 'id');
    }


    /**
     * Get admin
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getAdmin()
    {
        return $this->belongsTo(User::class, 'addedByAdminId', 'id');
    }
}