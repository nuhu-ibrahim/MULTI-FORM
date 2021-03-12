<?php

namespace App\Controllers;

use Core\App;

abstract class BaseController
{
    protected $container;

    public function __construct()
    {
        $this->container = App::class;
    }

    public function jsonResponse($data)
    {
        header('Content-Type: application/json');

        return json_encode($data);
    }
}
