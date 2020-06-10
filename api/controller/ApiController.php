<?php
/**
 * Created by PhpStorm.
 * User: credissimo
 * Date: 6/4/20
 * Time: 2:44 PM
 */

namespace Api\controller;


use App\models\User;
use App\traits\AclAwareTrait;
use Firebase\JWT\JWT;

class ApiController
{
    use AclAwareTrait;

    /**
     * @var
     */
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


        if ($this->checkAuth && !$this->checkJwtToken()) {
            return $this->throwError(INVALID_JWT_TOKEN, 'Invalid JWT token');
        }
    }


    /**
     * Check valid jwt token
     * @return bool
     */
    public function checkJwtToken()
    {
        $header = getallheaders();
        if (isset($header['Authorization'])) {
            try {
                $decodedData = JWT::decode($header['Authorization'], JWT_SECRET_KEY, ['HS256']);
                if (isset($decodedData->user) && isset($decodedData->user->userId)) {
                    session()->set('userId', $decodedData->user->userId);

                    /// set user to session
                    if (!session()->has('user')) {
                        $user = User::where('id', '=', $decodedData->user->userId)->first();
                        session()->set('user', $user);
                    }
                    return true;
                }
            } catch (\Exception $e) {
                return false;
            }
        }
        return false;
    }

    /**
     * Create JWT token
     * @param $user
     * @return string
     */
    protected function createJwtToken($user)
    {
        $iat = time();
        $nbf = time();
        $exp = ($iat + (60 * 24));
        $payloadInfo = [
            'iss' => request()->server('HTTP_HOST'),
            'iat' => time(),
            'nbf' => $nbf,
            'exp' => $exp,
            'aud' => 'api',
            'user' => [
                'userId' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]
        ];

        return JWT::encode($payloadInfo, JWT_SECRET_KEY);
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
        $resp['errors'] = [
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

        if (!is_array($iData)) {
            $iData = [$iData];
        }

        $data = array_merge($data, $iData);
        print(json_encode($data));
        exit();
    }
}