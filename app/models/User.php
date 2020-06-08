<?php


namespace App\models;

use App\models\UserRolesRel;
use Illuminate\Support\Facades\Hash;

class User extends AppModel
{

    /**
     * @var array
     */
    public $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function role()
    {
        return $this->hasMany(UserRolesRel::class, 'userId', 'id');
    }


    /**
     * @return bool
     */
    public function hasRole()
    {
        $row = $this->belongsTo(UserRolesRel::class, 'userId', 'id')
            ->where('isActive', '=', 'yes')
            ->first();

        return $row->exists();
    }


    /**
     * @param $roleId
     * @return bool
     */
    public function assignRole($roleId)
    {
        $row = UserRolesRel::create([
            'userId' => $this->id,
            'roleId' => $roleId,
            'isActive' => 'yes'
        ]);

        if (!is_null($row)) {
            return true;
        }
        return false;
    }


    /**
     * @param array $args
     * @return bool
     */
    public function getUser($args = [])
    {
        if (!isset($args['email']) || !isset($args['password'])) {
            return false;
        }

        $row = $this->where('email', '=', $args['email'])->first();
        if (!is_null($row) && password_verify($args['password'], $row->password)) {
            return $row;
        }
        return false;
    }
}