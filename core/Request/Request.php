<?php

namespace Core\Request;

class Request implements RequestInterface
{
    protected $data;

    public function __construct()
    {
        $this->data = $_REQUEST;
    }

    public function get($key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    public function post($key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    public static function uri()
    {
        return trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'
        );
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
