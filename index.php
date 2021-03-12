<?php

require 'core/bootstrap.php';

use Core\Request\Request;
use Core\Router\Router;

try {
	(new Router())->load('src/app/routes.php')
      ->direct(Request::uri(), Request::method());
} catch (Exception $ex) {
	die($ex->getMessage());
}
