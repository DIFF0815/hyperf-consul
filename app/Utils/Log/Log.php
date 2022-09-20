<?php
/**
 * Created by.
 * User: DIFF
 * DATE: 2022/6/27
 * TIME: 11:30
 */

namespace App\Utils\Log;

use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\ApplicationContext;

class Log
{
    public static function get(string $name = 'default', string $group = 'default'): \Psr\Log\LoggerInterface
    {
        return ApplicationContext::getContainer()->get(LoggerFactory::class)->get($name,$group);
    }

}