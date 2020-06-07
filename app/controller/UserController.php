<?php
/**
 * Created by PhpStorm.
 * User: credissimo
 * Date: 6/4/20
 * Time: 4:33 PM
 */

namespace App\controller;


use Rakit\Validation\Validator;

class UserController extends AppController
{
    /**
     * Disable check auth
     * @var bool
     */
    public $checkAuth = false;


    /**
     *
     */
    public function login()
    {
        if (request()->isPost()) {
            $validator = new Validator();
            $validation = $validator->make($_POST, [
                'email' => 'required|min:16',
                'password' => 'required|min:6',
            ]);
            $validation->validate();

            $data = $validation->getValidData();
        }

        return $this->render('login');
    }

}