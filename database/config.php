<?php

$config = [
    'default' => 'mysql',

    'connections' => [

        'sqlite' => [
            'driver'   => 'sqlite',
            'database' => 'database.sqlite',
            'prefix'   => '',
        ],
		
		'mysql' => [
            'driver'    => 'mysql',
            'host'      => 'mysql.hostinger.com.br',
            'database'  => 'u274078877_wme',
            'username'  => 'u274078877_wme',
            'password'  => 'wme1234567890',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],

        'mysqll' => [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'wmf',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],

        'pgsql' => [
            'driver'   => 'pgsql',
            'host'     => 'DB_HOST', 'localhost',
            'database' => 'DB_DATABASE', 'forge',
            'username' => 'DB_USERNAME', 'forge',
            'password' => 'DB_PASSWORD', '',
            'charset'  => 'utf8',
            'prefix'   => '',
            'schema'   => 'public',
        ],

        'sqlsrv' => [
            'driver'   => 'sqlsrv',
            'host'     => 'DB_HOST', 'localhost',
            'database' => 'DB_DATABASE', 'forge',
            'username' => 'DB_USERNAME', 'forge',
            'password' => 'DB_PASSWORD', '',
            'charset'  => 'utf8',
            'prefix'   => '',
        ]

    ]

];
?>