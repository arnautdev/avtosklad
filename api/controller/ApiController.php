<?php
/**
 * Created by PhpStorm.
 * User: credissimo
 * Date: 6/4/20
 * Time: 2:44 PM
 */

namespace Api\controller;


class ApiController
{

    private $request;

    /**
     * @var bool
     */
    public $checkAuth = true;


    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        $method = request()->method();
        if ($method !== 'POST') {
            return $this->throwError(100, 'Request method is not valid');
        }


        if ($this->checkAuth && !session()->has('userKey')) {
            return $this->throwError(100, 'Invalid JWT token');
        }


        $handler = fopen('php://input', 'r');
        $request = stream_get_contents($handler);
    }

    /**
     * Create JWT token
     */
    public function generateToken()
    {

    }

    /**
     * @param $code
     * @param $errorMsg
     * @return int
     */
    public function throwError($code, $errorMsg)
    {
        header('Content-type: application/json');
        $resp['status'] = true;
        $resp['code'] = $code;
        $resp['error'] = [
            'code' => $code,
            'errorMessage' => $errorMsg
        ];
        return print(json_encode($resp));
    }


    /**
     * @param $data
     * @param int $code
     * @return int
     */
    public function returnResponse($data, $code = 200)
    {
        header('Content-type: application/json');

        $data['status'] = true;
        $data['code'] = $code;
        return print(json_encode($data));
    }
}