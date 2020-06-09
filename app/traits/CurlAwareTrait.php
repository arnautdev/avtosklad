<?php

namespace App\traits;


use Curl\Curl;

trait CurlAwareTrait
{


    /**
     * @param null $endPoint
     * @param $jsonRequest
     */
    public function curlExec($endPoint = null, $jsonRequest)
    {

        $curl = new Curl();
        $curl->post($endPoint, $jsonRequest);
        return $curl->getResponse();
    }
}