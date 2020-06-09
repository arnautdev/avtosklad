<?php

namespace Api\controller;


use App\models\User;
use Rakit\Validation\Validator;

class LoginController extends ApiController
{
    /**
     * Set false for login
     * @var bool
     */
    public $checkAuth = false;

    /**
     * Login user
     */
    public function index()
    {
        $validator = new Validator();
        $validation = $validator->make($_POST, [
            'email' => 'required|min:6',
            'password' => 'required|min:6',
        ]);
        $validation->validate();

        /// check valid data
        /// if not return errors
        if ($validation->fails()) {
            $data['errors'] = $validation->errors()->all();
            return $this->returnResponse($data);
        }

        $data = $validation->getValidData();
        $user = (new User())->getUser($data);
        if (!$user) {
            $this->throwError(2000, ['Invalid credentials']);
        }

        $jwt = $this->createJwtToken($user);


        return $this->returnResponse([
            'user' => $user,
            'jwt' => $jwt
        ]);
    }
}