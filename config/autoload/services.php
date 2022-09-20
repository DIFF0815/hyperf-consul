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
    'enable' => [
        'discovery' => true,
        'register' => true,
    ],
    'consumers' => value(function (){
        $consumers = [];
        $services = [
            //多个服务
            'FooService' => App\JsonRpc\Consumer\FooServiceConsumerInterface::class,
        ];
        foreach ($services as $name => $interface) {
            $consumers[] = [
                'name' => $name,
                'service' => $interface,
                'id' => $interface,
                'protocol' => 'jsonrpc-http',
                'load_balancer' => 'random',
                'registry' => [
                    'protocol' => 'consul',
                    'address' => 'http://192.168.240.120:8500',
                ],
                //If `registry` is missing, then you should provide the nodes configs.
                'nodes' => [
                    ['host' => '192.168.240.120', 'port' => 9605],
                ],
                // 配置项，会影响到 Packer 和 Transporter
                /*'options' => [
                    'connect_timeout' => 5.0,
                    'recv_timeout' => 5.0,
                    'settings' => [
                        // 根据协议不同，区分配置
                        'open_eof_split' => true,
                        'package_eof' => "\r\n",
                        // 'open_length_check' => true,
                        // 'package_length_type' => 'N',
                        // 'package_length_offset' => 0,
                        // 'package_body_offset' => 4,
                    ],
                    // 当使用 JsonRpcPoolTransporter 时会用到以下配置
                    'pool' => [
                        'min_connections' => 1,
                        'max_connections' => 32,
                        'connect_timeout' => 10.0,
                        'wait_timeout' => 3.0,
                        'heartbeat' => -1,
                        'max_idle_time' => 60.0,
                    ],
                ],*/
            ];
        }

        return $consumers;
    }),
    'providers' => [],
    'drivers' => [
        'consul' => [
            'uri' => 'http://192.168.240.120:8500',
            'token' => '',
            'check' => [
                'deregister_critical_service_after' => '90m',
                'interval' => '1s',
            ],
        ],
    ],
];
