<?php

namespace App\JsonRpc\Consumer;

interface FooServiceConsumerInterface
{
    public function sum(int $a, int $b): int;

    public function diff(int $a, int $b): int;
}