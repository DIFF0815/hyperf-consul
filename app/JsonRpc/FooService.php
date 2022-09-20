<?php

namespace App\JsonRpc;

use Hyperf\RpcServer\Annotation\RpcService;

/**
 * @RpcService(name="FooService", protocol="jsonrpc-http", server="jsonrpc-http", publishTo="consul")
 * Class FooService
 * @package App\JsonRpc
 */
class FooService implements FooServiceInterface
{
    public function sum(int $a, int $b): int
    {
        return $a + $b;
    }

    public function diff(int $a, int $b): int
    {
        return $a - $b;
    }
}