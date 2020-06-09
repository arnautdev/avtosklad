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
     * Check if request is post
     * @return bool
     */
    public function isPost()
    {
        if ($this->method() == 'POST') {
            return true;
        }
        return false;
    }

    /**
     * @param string $url
     */
    public function url($url = '', $includeHost = false)
    {
        if ($includeHost) {
            return 'http://' . $this->server('HTTP_HOST') . $this->basePath() . $url;
        }

        return $this->basePath() . $url;
    }


    /**
     * @param string $url
     * @return string
     */
    public function apiUrl($url = '')
    {
        return API_HOST . '/' . $url;
    }


    /**
     * @param string $url
     */
    public function redirectTo($url = '')
    {
        if (is_array($url)) {
            $url = implode('/', $url);
        }

        $path = $this->basePath();

        return header('Location: ' . $path . $url);
    }

    /**
     * @return mixed
     */
    public function basePath()
    {
        return str_replace('index.php', '', $this->server('SCRIPT_NAME'));
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