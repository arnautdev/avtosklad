<?php

namespace Api\controller;


use App\models\User;
use Illuminate\Support\Facades\Validator;

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
            $errors = $validation->errors();
            return $this->returnResponse($errors, 200);
        }

        $data = $validation->getValidData();
    }
}