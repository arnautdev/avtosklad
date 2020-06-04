<?php


namespace App\models;

use App\models\UserRolesRel;

class User extends AppModel
{


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function role()
    {
        return $this->hasMany(UserRolesRel::class, 'userId', 'id');
    }
}