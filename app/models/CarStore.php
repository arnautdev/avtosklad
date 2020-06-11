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
        'availableCount',
        'status',
    ];


    /**
     *
     */
    protected static function boot()
    {
        parent::boot();

        /// when create init log
        static::created(function ($model) {
            $userId = session()->get('user')->id;
            StoreHistoryLog::create([
                'carId' => $model->carId,
                'availableCount' => $model->availableCount,
                'status' => $model->status,
                'addedByAdminId' => $userId,
            ]);
        });


        static::updated(function ($model) {
            if ($model->wasChanged(['availableCount', 'status'])) {
                $userId = session()->get('user')->id;
                StoreHistoryLog::create([
                    'carId' => $model->carId,
                    'availableCount' => $model->availableCount,
                    'status' => $model->status,
                    'addedByAdminId' => $userId,
                ]);
            }
        });
    }

    /**
     * Get car
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCar()
    {
        return $this->belongsTo(Car::class, 'carId', 'id');
    }
}