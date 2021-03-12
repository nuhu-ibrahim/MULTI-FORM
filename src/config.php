<?php

return [
    'database' => [
        'name'       => getenv('DB_NAME'),
        'username'   => getenv('DB_USERNAME'),
        'password'   => getenv('DB_PASSWORD'),
        'connection' => 'mysql:host='.getenv('DB_HOST'),
        'options'    => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ],
    ],
];
