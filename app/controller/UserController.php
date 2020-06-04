<?php
/**
 * Created by PhpStorm.
 * User: credissimo
 * Date: 6/4/20
 * Time: 4:33 PM
 */

namespace App\controller;


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

        
        return $this->render('login');
    }

}