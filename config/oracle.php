<?php

return [
    'f3a' => [
        'driver'         => 'oracle',
        'tns'            => env('DB_TNS_5', ''),
        'host'           => env('DB_HOST_5', ''),
        'port'           => env('DB_PORT_5', '1521'),
        'database'       => env('DB_DATABASE_5', ''),
        'username'       => env('DB_USERNAME_5', ''),
        'password'       => env('DB_PASSWORD_5', ''),
        'charset'        => env('DB_CHARSET_5', 'AL32UTF8'),
        'prefix'         => env('DB_PREFIX_5', ''),
        'prefix_schema'  => env('DB_SCHEMA_PREFIX_5', ''),
        'server_version' => env('DB_SERVER_VERSION_5', '11g'),
    ],
    'oraclecdmpvt' => [
        'driver'         => 'oracle',
        'tns'            => env('DB_TNS_3', ''),
        'host'           => env('DB_HOST_3', ''),
        'port'           => env('DB_PORT_3', '1521'),
        'database'       => env('DB_DATABASE_3', ''),
        'username'       => env('DB_USERNAME_3', ''),
        'password'       => env('DB_PASSWORD_3', ''),
        'charset'        => env('DB_CHARSET_3', 'AL32UTF8'),
        'prefix'         => env('DB_PREFIX_3', ''),
        'prefix_schema'  => env('DB_SCHEMA_PREFIX_3', ''),
        'server_version' => env('DB_SERVER_VERSION_3', '11g'),
    ],
];
