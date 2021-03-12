<?php

namespace Core\Request;

interface RequestInterface
{
    public static function uri();
    public function get($key, $default = null);
    public static function method();
}
