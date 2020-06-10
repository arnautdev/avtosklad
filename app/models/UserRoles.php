<?php
/**
 * Created by PhpStorm.
 * User: credissimo
 * Date: 6/4/20
 * Time: 2:00 PM
 */

namespace App\models;


class UserRoles extends AppModel
{
    const SUPER_ADMIN = 1;
    const MODERATOR = 2;

    /**
     * @var array
     */
    public $fillable = [
        'name',
    ];
}