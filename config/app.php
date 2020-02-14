<?php

return [
    'providers' => [
        \App\Table\TableServiceProvider::class,
        \App\Router\RouteServiceProvider::class,
        \App\Swoole\SwooleServiceProvider::class,
        \App\Database\DatabaseServiceProvider::class,
    ],
    'server' => [
        'host' => '127.0.0.1',
        'port' => '9501',
        'workers' => [
            \App\Workers\TestWorker::class,
            //\App\Workers\LogMessageConsumer::class,
        ],
        'settings' => [
            'open_http2_protocol' => true, // Enable HTTP2 protocol
            //'worker_num' => intval(shell_exec("grep -c processor /proc/cpuinfo")) / 2 - 1,
            'open_cpu_affinity' => true,
            'heartbeat_check_interval' => 60,
            'heartbeat_idle_time' => 120,
            //'dispatch_mode' => 2,
            'daemonize' => false, // For development purposes (only)
            'log_level' => 0
        ]
    ],
    'tables' => [
        'setting' => [
            'size' => 32,
            'fields' => [
                [
                    'name' => 'key',
                    'type' => Swoole\Table::TYPE_STRING,
                    'size' => 32,

                ]
            ]
        ],
        'users' => [
            'size' => 32,
            'fields' => [
                [
                    'name' => 'id',
                    'type' => Swoole\Table::TYPE_INT,
                ], [
                    'name' => 'name',
                    'type' => Swoole\Table::TYPE_STRING,
                    'size' => 32
                ], [
                    'name' => 'count',
                    'type' => Swoole\Table::TYPE_INT,
                ]
            ]
        ],
    ],
    'database' => [
        'driver' => 'mysql',
        'host' => getenv('DB_HOST'),
        'database' => getenv('DB_DATABASE'),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ]
];