<?php
/**
 * Created by PhpStorm.
 * User: credissimo
 * Date: 6/4/20
 * Time: 2:44 PM
 */

namespace Api\controller;


use Firebase\JWT\JWT;

class ApiController
{

    protected $request;

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
            return $this->throwError(INVALID_REQEUST, 'Request method is not valid');
        }


        if ($this->checkAuth && !session()->has('userKey')) {
            return $this->throwError(INVALID_JWT_TOKEN, 'Invalid JWT token');
        }


        $handler = fopen('php://input', 'r');
        $this->request = stream_get_contents($handler);
    }

    /**
     * Create JWT token
     * @param $user
     * @return string
     */
    protected function createJwtToken($user)
    {
        $iat = time();
        $nbf = ($iat + 10);
        $exp = ($iat + 30);
        $payloadInfo = [
            'iss' => request()->server('HTTP_HOST'),
            'iat' => time(),
            'nbf' => $nbf,
            'exp' => $exp,
            'aud' => 'api',
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
            ]
        ];

        return JWT::encode($payloadInfo, 'owt125');
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
        print(json_encode($resp));
        exit();
    }


    /**
     * @param $data
     * @param int $code
     * @return int
     */
    public function returnResponse($iData, $code = 200)
    {
        header('Content-type: application/json');

        $data['status'] = true;
        $data['code'] = $code;
        $data = array_merge($data, $iData);
        print(json_encode($data));
        exit();
    }
}