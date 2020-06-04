<?php
/**
 * Created by PhpStorm.
 * User: credissimo
 * Date: 6/4/20
 * Time: 2:00 PM
 */

namespace App\models;

use App\models\User;
use App\models\UserRoles;

class UserRolesRel extends AppModel
{

    public $fillable = [
        'userId',
        'roleId',
    ];

    /**
     * Get user
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }


    /**
     * Get role
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(UserRoles::class, 'userId', 'id');
    }
}