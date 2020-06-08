<?php
/**
 * Created by PhpStorm.
 * User: credissimo
 * Date: 6/4/20
 * Time: 4:33 PM
 */

namespace App\controller;


use App\models\User;
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
            if ($validation->fails()) {
                $this->vars['errors'] = $validation->errors();
                return $this->render('login');
            }


            /// login user
            $data = $validation->getValidData();
            $user = (new User())->getUser($data);
            if (!$user) {
                $this->vars['errors'] = ['Invalid user or password'];
                return $this->render('login');
            }

            session()->set('user', $user);
            return request()->redirectTo('/');
        }

        return $this->render('login');
    }

}