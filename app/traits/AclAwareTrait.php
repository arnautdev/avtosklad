<?php

namespace App\traits;


use App\models\UserRoles;

trait AclAwareTrait
{

    /**
     * @var array
     */
    public $tablePermissions = [
        UserRoles::SUPER_ADMIN => [
            '*'
        ],

        UserRoles::MODERATOR => [
            'cars.index',
            'cars.create',
            'cars.update',
        ],
    ];

    /**
     * Cehck available permission
     * @param string $permission
     * @return bool
     */
    public function hasPermission($permission = '')
    {
        $user = session()->get('user');
        if (is_null($user)) {
            return false;
        }

        $userRole = $user->role()->first();
        if (is_null($userRole)) {
            return false;
        }

        $userRoleId = $userRole->roleId;
        if (!isset($this->tablePermissions[$userRoleId])) {
            return false;
        }

        /// when is super admin return true for all actions
        if ($userRoleId == UserRoles::SUPER_ADMIN) {
            return true;
        }


        /// when logged moderator check available permissions
        if (isset($this->tablePermissions[$userRoleId]) && in_array($permission, $this->tablePermissions[$userRoleId])) {
            return true;
        }

        return false;
    }
}