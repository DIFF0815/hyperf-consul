<?php
/**
 * Created by.
 * User: DIFF
 * DATE: 2022/6/28
 * TIME: 10:55
 */

namespace App\Utils\Log;

use Hyperf\Logger\LoggerFactory;
use Psr\Container\ContainerInterface;

class StdoutLoggerFactory
{
    public function __invoke(ContainerInterface $container): \Psr\Log\LoggerInterface
    {
        return $container->get(LoggerFactory::class)->get('sys','stdout');
    }
}