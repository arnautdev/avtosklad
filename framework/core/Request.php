<?php

namespace Framework\core;

class Request
{

    /**
     * @var
     */
    private $request;


    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->request = $_REQUEST;
    }


    /**
     * Get server vars
     * @param null $key
     * @return bool
     */
    public function server($key = null)
    {
        if (!is_null($key) && isset($_SERVER[$key])) {
            return $_SERVER[$key];
        }
        return false;
    }

    /**
     * Get request method
     * @return bool
     */
    public function method()
    {
        return $this->server('REQUEST_METHOD');
    }

    /**
     * Get request uri
     * @return bool
     */
    public function uri()
    {
        return $this->server('REQUEST_URI');
    }

    /**
     * Get request uri
     * @return bool
     */
    public function query($key = null)
    {
        if (!is_null($key) && isset($this->request[$key])) {
            return $this->request[$key];
        }


        if (isset($this->server['QUERY_STRING'])) {
            return $this->server['QUERY_STRING'];
        }

        return false;
    }


}