<?php

namespace Core\Router;

interface RouterInterface
{
    public function load($file);
    public function get($uri, $controller);
    public function post($uri, $controller);
    public function direct($uri, $requestType);
}
