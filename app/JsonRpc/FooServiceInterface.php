<?php

namespace App\JsonRpc;

interface FooServiceInterface
{
    public function sum(int $a, int $b): int;

    public function diff(int $a, int $b): int;
}