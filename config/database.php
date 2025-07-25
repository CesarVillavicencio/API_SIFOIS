<?php

use Illuminate\Support\Str;

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

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

        'firebird_config' => [
            'driver'   => 'firebird',
            'host'     => env('FB_CONFIG_DB_HOST', 'localhost'),
            'port'     => env('FB_CONFIG_DB_PORT', '3050'),
            'database' => env('FB_CONFIG_DB_DATABASE', '/path_to/database.fdb'),
            'username' => env('FB_CONFIG_DB_USERNAME', 'sysdba'),
            'password' => env('FB_CONFIG_DB_PASSWORD', 'masterkey'),
            'charset'  => env('FB_CONFIG_DB_CHARSET', 'UTF8'),
            'role'     => null,
        ],

        'firebird_security' => [
            'driver'   => 'firebird',
            'host'     => env('FB_SECURITY_DB_HOST', 'localhost'),
            'port'     => env('FB_SECURITY_DB_PORT', '3050'),
            'database' => env('FB_SECURITY_DB_DATABASE', '/path_to/database.fdb'),
            'username' => env('FB_SECURITY_DB_USERNAME', 'sysdba'),
            'password' => env('FB_SECURITY_DB_PASSWORD', 'masterkey'),
            'charset'  => env('FB_SECURITY_DB_CHARSET', 'UTF8'),
            'role'     => null,
        ],

        'firebird_garza_reyna_local' => [
            'driver'   => 'firebird',
            'host'     => env('FB_GARZA_REYNA_LOCAL_DB_HOST', 'localhost'),
            'port'     => env('FB_GARZA_REYNA_LOCAL_DB_PORT', '3050'),
            'database' => env('FB_GARZA_REYNA_LOCAL_DB_DATABASE', '/path_to/database.fdb'),
            'username' => env('FB_GARZA_REYNA_LOCAL_DB_USERNAME', 'sysdba'),
            'password' => env('FB_GARZA_REYNA_LOCAL_DB_PASSWORD', 'masterkey'),
            'charset'  => env('FB_GARZA_REYNA_LOCAL_DB_CHARSET', 'UTF8'),
            'role'     => null,
        ],

        'firebird_metadatos' => [
            'driver'   => 'firebird',
            'host'     => env('FB_METADATOS_DB_HOST', 'localhost'),
            'port'     => env('FB_METADATOS_DB_PORT', '3050'),
            'database' => env('FB_METADATOS_DB_DATABASE', '/path_to/database.fdb'),
            'username' => env('FB_METADATOS_DB_USERNAME', 'sysdba'),
            'password' => env('FB_METADATOS_DB_PASSWORD', 'masterkey'),
            'charset'  => env('FB_METADATOS_DB_CHARSET', 'UTF8'),
            'role'     => null,
        ],

        'mongodb' => [
            'host' => env('MONGODB_HOST', '127.0.0.1'),
            'port' => env('MONGODB_PORT', 27017),
            'database' => env('MONGODB_DATABASE', 'homestead'),
            
            'options' => 
            env('CATALOGO_PAGE') ? [
                'appname' => 'homestead',
                'database' => 'admin', // <=== here
                'username'=> env('CATALOGOS_DESTINATION_RESTORE_MONGODB_USERNAME', ''),
                'password'=> env('CATALOGOS_DESTINATION_RESTORE_MONGODB_PASSWORD', ''),               
            ] : [
                'appname' => 'homestead',               
            ] 
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
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

        'session' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => '2',
            'prefix' => 's:'
        ],
    ],

];
