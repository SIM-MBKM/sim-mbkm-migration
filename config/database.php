<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for database operations. This is
    | the connection which will be utilized unless another connection
    | is explicitly specified when you execute a query / statement.
    |
    */

    'default' => env('DB_CONNECTION', 'sqlite'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Below are all of the database connections defined for your application.
    | An example configuration is provided for each database system which
    | is supported by Laravel. You're free to add / remove connections.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DB_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
            'busy_timeout' => null,
            'journal_mode' => null,
            'synchronous' => null,
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'mariadb' => [
            'driver' => 'mariadb',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
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
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'auth_management' => [
            'driver' => 'pgsql',
            'url' => env('DB_URL_AUTH_SERVICE'),
            'host' => env('DB_AUTH_SERVICE_HOST', '127.0.0.1'),
            'port' => env('DB_AUTH_SERVICE_PORT', '5432'),
            'database' => env('DB_AUTH_SERVICE_DATABASE', 'laravel'),
            'username' => env('DB_AUTH_SERVICE_USERNAME', 'root'),
            'password' => env('DB_AUTH_SERVICE_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'user_management' => [
            'driver' => 'pgsql',
            'url' => env('DB_URL_USER_SERVICE'),
            'host' => env('DB_USER_SERVICE_HOST', '127.0.0.1'),
            'port' => env('DB_USER_SERVICE_PORT', '5432'),
            'database' => env('DB_USER_SERVICE_DATABASE', 'laravel'),
            'username' => env('DB_USER_SERVICE_USERNAME', 'root'),
            'password' => env('DB_USER_SERVICE_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'activity_management' => [
            'driver' => 'pgsql',
            'url' => env('DB_URL_ACTIVITY_SERVICE'),
            'host' => env('DB_ACTIVITY_SERVICE_HOST', '127.0.0.1'),
            'port' => env('DB_ACTIVITY_SERVICE_PORT', '5432'),
            'database' => env('DB_ACTIVITY_SERVICE_DATABASE', 'laravel'),
            'username' => env('DB_ACTIVITY_SERVICE_USERNAME', 'root'),
            'password' => env('DB_ACTIVITY_SERVICE_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'registration_management' => [
            'driver' => 'pgsql',
            'url' => env('DB_URL_REGISTRATION_SERVICE'),
            'host' => env('DB_REGISTRATION_SERVICE_HOST', '127.0.0.1'),
            'port' => env('DB_REGISTRATION_SERVICE_PORT', '5432'),
            'database' => env('DB_REGISTRATION_SERVICE_DATABASE', 'laravel'),
            'username' => env('DB_REGISTRATION_SERVICE_USERNAME', 'root'),
            'password' => env('DB_REGISTRATION_SERVICE_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'matching_management' => [
            'driver' => 'pgsql',
            'url' => env('DB_URL_MATCHING_SERVICE'),
            'host' => env('DB_MATCHING_SERVICE_HOST', '127.0.0.1'),
            'port' => env('DB_MATCHING_SERVICE_PORT', '5432'),
            'database' => env('DB_MATCHING_SERVICE_DATABASE', 'laravel'),
            'username' => env('DB_MATCHING_SERVICE_USERNAME', 'root'),
            'password' => env('DB_MATCHING_SERVICE_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'monitoring_management' => [
            'driver' => 'pgsql',
            'url' => env('DB_URL_MONITORING_SERVICE'),
            'host' => env('DB_MONITORING_SERVICE_HOST', '127.0.0.1'),
            'port' => env('DB_MONITORING_SERVICE_PORT', '5437'),
            'database' => env('DB_MONITORING_SERVICE_DATABASE', 'laravel'),
            'username' => env('DB_MONITORING_SERVICE_USERNAME', 'root'),
            'password' => env('DB_MONITORING_SERVICE_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'monev_management' => [
            'driver' => 'pgsql',
            'url' => env('DB_URL_MONEV_SERVICE'),
            'host' => env('DB_MONEV_SERVICE_HOST', '127.0.0.1'),
            'port' => env('DB_MONEV_SERVICE_PORT', '5436'),
            'database' => env('DB_MONEV_SERVICE_DATABASE', 'laravel'),
            'username' => env('DB_MONEV_SERVICE_USERNAME', 'root'),
            'password' => env('DB_MONEV_SERVICE_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'calendar_management' => [
            'driver' => 'pgsql',
            'url' => env('DB_URL_CALENDAR_SERVICE'),
            'host' => env('DB_CALENDAR_SERVICE_HOST', '127.0.0.1'),
            'port' => env('DB_CALENDAR_SERVICE_PORT', '5432'),
            'database' => env('DB_CALENDAR_SERVICE_DATABASE', 'laravel'),
            'username' => env('DB_CALENDAR_SERVICE_USERNAME', 'root'),
            'password' => env('DB_CALENDAR_SERVICE_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'report_management' => [
            'driver' => 'pgsql',
            'url' => env('DB_URL_REPORT_SERVICE'),
            'host' => env('DB_REPORT_SERVICE_HOST', '127.0.0.1'),
            'port' => env('DB_REPORT_SERVICE_PORT', '5432'),
            'database' => env('DB_REPORT_SERVICE_DATABASE', 'laravel'),
            'username' => env('DB_REPORT_SERVICE_USERNAME', 'root'),
            'password' => env('DB_REPORT_SERVICE_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'notification' => [
            'driver' => 'pgsql',
            'url' => env('DB_URL_NOTIFICATION_SERVICE'),
            'host' => env('DB_NOTIFICATION_SERVICE_HOST', '127.0.0.1'),
            'port' => env('DB_NOTIFICATION_SERVICE_PORT', '5432'),
            'database' => env('DB_NOTIFICATION_SERVICE_DATABASE', 'laravel'),
            'username' => env('DB_NOTIFICATION_SERVICE_USERNAME', 'root'),
            'password' => env('DB_NOTIFICATION_SERVICE_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            // 'encrypt' => env('DB_ENCRYPT', 'yes'),
            // 'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run on the database.
    |
    */

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as Memcached. You may define your connection settings here.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_') . '_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

    'Mv1' => [
        'base_dir' => 'database/migrations'
    ],
];
