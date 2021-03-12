<?php
// Start a Session
if( !session_id() ) @session_start();

require 'vendor/autoload.php';
(new \Dotenv\Dotenv(__DIR__.'/../'))->load();

use Core\App;
use Core\Database\Connection;

App::bind('config', require 'src/config.php');
App::bind('database', Connection::make(App::get('config')['database']));

// Bind any other services.
