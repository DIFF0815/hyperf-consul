<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    'default' => [
        'host' => env('REDIS_HOST', 'localhost'),
        'auth' => env('REDIS_AUTH', null),
        'port' => (int) env('REDIS_PORT', 6379),
        'db' => (int) env('REDIS_DB', 0),
        'pool' => [
            'min_connections' => 1,
            'max_connections' => 10,
            'connect_timeout' => 10.0,
            'wait_timeout' => 3.0,
            'heartbeat' => -1,
            'max_idle_time' => (float) env('REDIS_MAX_IDLE_TIME', 60),
        ],
        'options' => [

        ],
    ],
    'redis_persist' => [
        'host' => env('REDIS_PERSIST_HOST', 'localhost'),
        'auth' => env('REDIS_PERSIST_AUTH', null),
        'port' => (int) env('REDIS_PERSIST_PORT', 6379),
        'db' => (int) env('REDIS_PERSIST_DB', 0),
        'pool' => [
            'min_connections' => 1,
            'max_connections' => 10,
            'connect_timeout' => 10.0,
            'wait_timeout' => 3.0,
            'heartbeat' => -1,
            'max_idle_time' => (float) env('REDIS_PERSIST_MAX_IDLE_TIME', 60),
        ],
        'options' => [
            Redis::OPT_READ_TIMEOUT => -1,
            Redis::OPT_SERIALIZER => Redis::SERIALIZER_MSGPACK
        ],
    ],
    'redis_session' => [
        'host' => env('REDIS_SESSION_HOST', 'localhost'),
        'auth' => env('REDIS_SESSION_AUTH', null),
        'port' => (int) env('REDIS_SESSION_PORT', 6379),
        'db' => (int) env('REDIS_SESSION_DB', 0),
        'pool' => [
            'min_connections' => 1,
            'max_connections' => 10,
            'connect_timeout' => 10.0,
            'wait_timeout' => 3.0,
            'heartbeat' => -1,
            'max_idle_time' => (float) env('REDIS_SESSION_MAX_IDLE_TIME', 60),
        ],
    ],
];
