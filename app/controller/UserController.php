<?php
/**
 * Created by PhpStorm.
 * User: credissimo
 * Date: 6/4/20
 * Time: 4:33 PM
 */

namespace App\controller;


use App\models\User;
use App\traits\CurlAwareTrait;
use Rakit\Validation\Validator;

class UserController extends AppController
{
    use CurlAwareTrait;

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

            $endPoint = request()->apiUrl('login');
            $resp = $this->curlExec($endPoint, $data);
            if (isset($resp->jwt)) {
                session()->set('jwtToken', $resp->jwt);
                session()->set('user', $user);
                return request()->redirectTo('/');
            }

            /// show errors
            if (isset($resp->errors)) {
                $this->vars['errors'] = $resp->errors;
                return $this->render('login');
            }
        }

        return $this->render('login');
    }

    /**
     *
     */
    public function logout()
    {
        session()->remove('jwtToken');
        session()->remove('user');
        return request()->redirectTo('/');
    }

}