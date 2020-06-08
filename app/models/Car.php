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
    ];

    /**
     *
     */
    public static function boot()
    {
        parent::boot();

        /// on before save json-encode (technicalSpecifications)
        static::saving(function ($model) {
            if (!is_array($model->technicalSpecifications)) {
                $model->technicalSpecifications = [$model->technicalSpecifications];
            }
            
            $model->technicalSpecifications = json_encode($model->technicalSpecifications);
        });
    }

    /**
     * Get car store
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getCarStore()
    {
        return $this->hasOne(CarStore::class, 'carId', 'id');
    }
}