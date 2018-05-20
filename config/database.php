<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        /**
         * 基础数据库
         * 包含网站的基本数据
         */
        'mysql_backend' => [
            'driver' => 'mysql',
            'host' => env('APP_ENV') === 'production' ? env('DB_PROV_BASIC') :
                (env('APP_ENV') === 'testing' ? env('DB_TEST_BASIC') : env('DB_LOCAL_BASIC')),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_BASIC_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_USERNAME', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'timezone'  => env('DB_TIMEZONE','+00:00'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => 'itls_',
            'strict' => true,
            'engine' => null,
        ],

        /**
         * 英文版网站MySQL
         * 英文站点数据
         */
        'mysql_global' => [
            'driver' => 'mysql',
            'host' => env('APP_ENV') === 'production' ? env('DB_PROV_GLOBAL') :
                (env('APP_ENV') === 'testing' ? env('DB_TEST_GLOBAL') : env('DB_LOCAL_GLOBAL')),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_GLOBAL_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_USERNAME', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'timezone'  => env('DB_TIMEZONE','+00:00'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => 'itls_',
            'strict' => true,
            'engine' => null,
        ],

        /**
         * 中文版网站MySQL
         */
        'mysql_china' => [
            'driver' => 'mysql',
            'host' => env('APP_ENV') === 'production' ? env('DB_PROV_CN') :
                (env('APP_ENV') === 'testing' ? env('DB_TEST_CN') : env('DB_LOCAL_CN')),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_CN_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_USERNAME', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'timezone'  => env('DB_TIMEZONE','+00:00'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => 'itls_',
            'strict' => true,
            'engine' => null,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => 'predis',

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => 0,
        ],

    ],

];
