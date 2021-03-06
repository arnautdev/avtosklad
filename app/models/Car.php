<?php
/**
 * Created by PhpStorm.
 * User: credissimo
 * Date: 6/4/20
 * Time: 2:00 PM
 */

namespace App\models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Events\Dispatcher;

class Car extends AppModel
{
    use SoftDeletes;

    /**
     * @var array
     */
    public $fillable = [
        'brand',
        'model',
        'issueYear',
        'equipment',
        'technicalSpecifications',
//        'status',
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

    /**
     * Get user
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function getUser()
    {
        return $this->belongsTo(User::class, 'addedByAdminId', 'id');
    }

    /**
     * @param $args
     * @return int
     */
    public function initStorage($args)
    {
        $args['carId'] = $this->id;
        $storage = CarStore::create($args);
        return intval($storage->id);
    }
}