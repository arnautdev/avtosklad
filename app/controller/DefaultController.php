<?php
/**
 * Created by PhpStorm.
 * User: credissimo
 * Date: 6/4/20
 * Time: 10:41 AM
 */

namespace App\controller;


use App\models\Car;
use App\models\User;
use App\models\UserRoles;

class DefaultController extends AppController
{
    public $checkAuth = false;

    /**
     *
     */
    public function index()
    {
        /// create user roles
        $roles = UserRoles::where('name', '=', 'SuperAdmin')->first();
        if (is_null($roles)) {
            UserRoles::create(['name' => 'SuperAdmin']);
            UserRoles::create(['name' => 'Moderator']);
        }


        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// create user(Super Admin)
        $user = (new User())->getUser([
            'email' => 'dmitrii.arnaut@gmail.com',
            'password' => 'dmitrii.arnaut@gmail.com',
        ]);
        if (!$user) {
            $user = User::create([
                'email' => 'dmitrii.arnaut@gmail.com',
                'name' => 'Dmitry Arnaut',
                'password' => password_hash('dmitrii.arnaut@gmail.com', PASSWORD_DEFAULT)
            ]);
            /// assign user role
            $user->assignRole(1);
        }

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // create user(Moderator)
        $user = (new User())->getUser([
            'email' => 'moderator@gmail.com',
            'password' => 'moderator@gmail.com',
        ]);
        if (!$user) {
            $user = User::create([
                'email' => 'moderator@gmail.com',
                'name' => 'Moderator User',
                'password' => password_hash('moderator@gmail.com', PASSWORD_DEFAULT)
            ]);
            /// assign user role
            $user->assignRole(2);
        }


        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Render view

        $this->render('index');
    }
}