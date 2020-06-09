<?php

namespace App\traits;


use Curl\Curl;
use Firebase\JWT\JWT;

trait CurlAwareTrait
{


    /**
     * @param null $endPoint
     * @param $jsonRequest
     */
    public function curlExec($endPoint = null, $jsonRequest = [])
    {

        $curl = new Curl();

        $jwtKey = session()->get('jwtToken');

        if (!is_null($jwtKey)) {
            $curl->setHeader('Authorization', $jwtKey);
        }

        $curl->post($endPoint, $jsonRequest);
//        die(var_dump($curl));
        $resp = json_decode($curl->getResponse());
        if (isset($resp->errors) && $resp->errors->errorMessage == 'Invalid JWT token') {
            session()->remove('user');
            session()->remove('jwtToken');
            return request()->redirectTo('');
        }
        return $resp;
    }
}